<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
//use Cake\Utility\Xml;
use Cake\Core\App;

require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'XMLFunctions.php');
require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'NodeStack.php');

use XMLFunctions;
use NodeStack;

/**
 * MergeTemplates component
 */
class MergeTemplatesComponent extends Component {

//	private $skipemptynodes = '/node()[not(self::text()[not(normalize-space())])]';
//	private $skipempty = '[not(self::text()[not(normalize-space())])]';
	private $basequery = '//*' . '/node()[not(self::text()[not(normalize-space())])]';
	private $from_xml;
	private $to_xml;
	private $tpath;
	private $fpath;
	private $idattribute = 'XMLID';
	private $errorstack = [];

	public function setConfiguration(array $config) {
		if (isset($config['allowtext']) && $config['allowtext']) {
			$this->skipempty = '';
			$this->skipemptynodes = '/node()';
		}
		if (isset($config['basequery']) && $config['basequery']) {
			$this->basequery = $config['basequery'];
		}
		if (isset($config['idattribute']) && $config['idattribute']) {
			$this->idattribute = $config['idattribute'];
		}

		$this->XMLFunctions = new XMLFunctions(['idattribute' => $this->idattribute]);
		$this->NodeStack = new NodeStack();

		$this->to_xml = new \DOMDocument();
		$this->to_xml->loadXML($config['to_xml']->saveXML());
		$this->XMLFunctions->renameElement($this->to_xml->documentElement, 'HEROCSHEET');
		$this->standardizeTemplate($this->to_xml);
		$this->tpath = new \DOMXPath($this->to_xml);

		$this->from_xml = new \DOMDocument();
		$this->from_xml->loadXML($config['from_xml']->saveXML());
		$this->XMLFunctions->renameElement($this->from_xml->documentElement, 'HEROCSHEET');
		$this->standardizeTemplate($this->from_xml);
		$this->fpath = new \DOMXPath($this->from_xml);
	}

	function mergeTemplates($nodestack = null) {
		$this->errorstack[] = 'mergeTemplate';
		if (!$nodestack) {
			$nodestack = $this->NodeStack->parseNodeString($this->basequery);
		}
		$nodequery = $this->NodeStack->buildNodeString($nodestack, false);
		$nodelist = $this->fpath->query($nodequery . $this->XMLFunctions->buildSkipEmpty());
		if ($nodelist->length != 1) {
			debug("More than one node in nodelist: " . $nodequery . " - Qty: " . $nodelist->length);
			$this->XMLFunctions->displayNodeList($nodelist);
			die("More than one node in nodelist");
		}
		$node = $nodelist->item(0);
		if (!($matchednode = $this->getMatchingNode($nodequery, $node))) {
			if (!($matchednode = $this->XMLFunctions->findOrCreateNodePath($this->to_xml, $nodequery))) {
				// findOrCreateNodePath has failed
				return null;
			}
		}
		$this->updateAttributes($matchednode, $node);
		if ($node->hasChildNodes()) {
			foreach ($node->childNodes as $child) {
				if ($child->nodeType == XML_TEXT_NODE) {
					// This is technically an error because text nodes shouldn't be processed.  Replacement/merge happens at their parent level
//					debug('Text Node');
//					$this->XMLFunctions->displayNode($child);
				} elseif ($child->nodeName == 'TYPE') {
					// Ignore TYPE nodes.  Duplicates are allowed.  Handled in standardization by setting their XMLID attribute
				} else {
					$childnodestack = $this->NodeStack->addQueryLevel($nodestack, $child, [$this->idattribute]);
					$this->mergeTemplates($childnodestack);
				}
			}
		}
		return $this->to_xml;
	}

//	function attachEmptyFilter($nodequery) {
//		$nodequery .= $this->skipempty;
//		return $nodequery;
//	}
//
//	function addQueryLevel($nodequery, &$node) {
//		$nodequery .= '/' . $node->nodeName;
//		if ($node->hasAttribute($this->idattribute)) {
//			$nodequery .= "[@" . $this->idattribute . " = '" . $node->getAttribute($this->idattribute) . "']";
//		}
//		return $nodequery;
//	}
//
//	function removeQueryLevel($nodequery) {
//		$nodequery = substr($nodequery, 0, strrpos($nodequery, '/'));
//		return $nodequery;
//	}

	function getMatchingNode($nodequery, &$node) {
		$nodelist = $this->tpath->query($nodequery . $this->XMLFunctions->buildSkipEmpty());
		switch ($nodelist->length) {
			case 0:
				// No match found (Caller determines if error)
				return false;
				break;
			case 1:
				// Match found, return matching node in $this->tpath
				return $nodelist->item(0);
				break;
			default:
				// This means that there are multiple matching tag/xmlid combinations
				// TODO Handle multiple matches.  It looks like they're all empty nodes
				debug('Multiple tag/xmlid matches found: ' . $nodequery);
				$this->XMLFunctions->displayNodeList($nodelist);
				break;
		}
	}

	function getLowestMatchingParent($nodequery, $node) {
		do {
			$gmn = $this->getMatchingNode($nodequery, $node);
			if ($node->parentNode) {
				$node = $node->parentNode;
				$nodequery = $this->removeQueryLevel($nodequery);
			} else {
				return false;
			}
		} while (!$gmn);
		return $gmn;
	}

	function updateAttributes(&$tonode, &$fromnode) {
		if (!$tonode->hasAttributes() || !$fromnode->hasAttributes()) {
			return 'No Attributes to merge';
		}
		if ($tonode->nodeType == XML_TEXT_NODE || $fromnode->nodeType == XML_TEXT_NODE) {
			return 'One or both are TEXT nodes';
		}
		foreach ($fromnode->attributes as $attribute) {
			$tonode->setAttribute($attribute->name, $attribute->value);
		}
	}

	function standardizeTemplate(&$domdocument) {
//		debug('Standardizing Template');
		$documentelementname = $domdocument->documentElement->nodeName;
//		debug($documentelementname);
		$update = [
			'PERKS' => 'PERK',
			'TALENTS' => 'TALENT',
			'SKILLS' => 'SKILL',
			'DISADVANTAGES' => 'DISAD',
			'POWERS' => 'POWER'
		];
		foreach ($update as $ukey => $uvalue) {
			$nodequerystring = '/' . $documentelementname . '/' . $ukey;
			$nodequery = $this->XMLFunctions->buildNodeQuery($nodequerystring);
			$nodelist = $this->XMLFunctions->getNodeList($domdocument, $nodequery);
			$this->templateNodesToTag($nodelist, $uvalue);
		}
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('/' . $documentelementname . '/MARTIAL_ARTS'));
		$this->templateXmlidToDisplay($nodelist, 'MANEUVER');
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('/' . $documentelementname . '/CHARACTERISTICS'));
		$this->templateXmlidToDisplay($nodelist);
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('//TYPE', false, false));
		$this->templateXmlidToNodeValue($nodelist);
	}

	function templateNodesToTag($nodelist, $name) {
		foreach ($nodelist as $node) {
//			debug($node->getNodePath());
			if ($node->nodeName != $name) {
				$this->XMLFunctions->renameElement($node, $name, $node->nodeName);
			}
		}
	}

	function templateNodesToXmlid($nodelist, $name) {
		foreach ($nodelist as $node) {
			if ($node->nodeName == $name) {
				$this->XMLFunctions->renameElement($node, $node->getAttribute($this->idattribute), false);
			}
		}
	}

	function templateXmlidToDisplay($nodelist, $name = null) {
		foreach ($nodelist as $node) {
//			debug($node->nodeName);
			if (!$name || $node->nodeName == $name) {
//				debug($this->XMLFunctions->cleanStringForTagName($node->getAttribute('DISPLAY')));
				$node->setAttribute($this->idattribute, $this->XMLFunctions->cleanStringForTagName($node->getAttribute('DISPLAY')));
//				debug($node->getAttribute($this->idattribute));
			}
		}
	}

	function templateXmlidToNodeValue($nodelist) {
		foreach ($nodelist as $node) {
			if ($node->nodeType == XML_TEXT_NODE) {
				$node->parentNode->setAttribute($this->idattribute, $this->XMLFunctions->cleanStringForTagName($node->nodeValue));
			} else {
//				debug('Should be a text node: ' . $node->nodeType);
//				$this->XMLFunctions->displayNode($node);
			}
		}
	}

}
