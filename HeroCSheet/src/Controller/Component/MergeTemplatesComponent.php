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
	private $basequery = '//*';
	private $from_xml;
	private $to_xml;
	private $tpath;
	private $fpath;
	private $idattribute = 'XMLID';

	public function setConfiguration(array $config) {
		$this->XMLFunctions = new XMLFunctions();
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

//		if (isset($config['allowtext']) && $config['allowtext']) {
//			$this->skipempty = '';
//			$this->skipemptynodes = '/node()';
//		}
		if (isset($config['basequery']) && $config['basequery']) {
			$this->basequery = $config['basequery'];
		}
		if (isset($config['idattribute']) && $config['idattribute']) {
			$this->idattribute = $config['idattribute'];
		}
	}

	function mergeTemplates($nodequery = null, $depth = 0) {
		if (!$nodequery) {
			$nodequery = $this->basequery;
		}
		$nodelist = $this->fpath->query($this->XMLFunctions->buildNodeQuery($nodequery, false, true));
		if ($nodelist->length != 1) {
			debug("More than one node in nodelist: " . $this->attachEmptyFilter($nodequery) . " - Qty: " . $nodelist->length);
			$this->displayNodeList($nodelist);
			die();
		}
		$node = $nodelist->item(0);
		if ($matchednode = $this->getMatchingNode($nodequery, $node)) {
			$this->updateAttributes($matchednode, $node);
		} else {
			if ($matchedparent = $this->getLowestMatchingParent($nodequery, $node)) {
				//debug('Parent match found: ' . $matchedparent->getNodePath() . ' for query: ' . $nodequery);
				$parentnode = $this->tpath->query($matchedparent->getNodePath())->item(0);
				//debug($parentnode->getNodePath());
				//debug($node->getNodePath());
				$parentarray = explode('/', $matchedparent->getNodePath());
				$this->displayNode($node);
				$nodearray = explode('/', $nodequery);
				//debug($parentarray);
				//debug($nodearray);
				$steps = count($nodearray) - count($parentarray);
				//debug($steps);
				if ($steps == 1) {
					$addchild = $parentnode->ownerDocument->importNode($node);
					$parentnode->appendChild($addchild);
				} else {
					die('<h1>Steps: ' . $steps . ' is greater than 1</h1>');
				}
				//TODO: Append node path to new parent
			} else {
				// Should be an error because everything has the same root node
				die('Node not found and no common parent found: ' . $nodequery);
			}
		}
		if ($node->hasChildNodes()) {
			foreach ($node->childNodes as $child) {
				if ($child->nodeType == XML_TEXT_NODE) {
					// This is technically an error because text nodes shouldn't be processed.  Replacement/merge happens at their parent level
//					debug('Text Node');
					$this->displayNode($child);
				}elseif($child->nodeName == 'TYPE'){
					// Ignore TYPE nodes.  Duplicates are allowed.  Handled in standardization by setting their XMLID attribute
				} else {
					$childnodequery = $this->addQueryLevel($nodequery, $child);
					$this->mergeTemplates($childnodequery, $depth + 1);
				}
			}
		}
//				$node->parentNode->removeChild($node);
		return $this->to_xml;
	}

//	function attachEmptyFilter($nodequery) {
//		$nodequery .= $this->skipempty;
//		return $nodequery;
//	}

	function addQueryLevel($nodequery, &$node) {
		$nodequery .= '/' . $node->nodeName;
		if ($node->hasAttribute($this->idattribute)) {
			$nodequery .= "[@" . $this->idattribute . " = '" . $node->getAttribute($this->idattribute) . "']";
		}
		return $nodequery;
	}

	function removeQueryLevel($nodequery) {
		$nodequery = substr($nodequery, 0, strrpos($nodequery, '/'));
		return $nodequery;
	}

	function getMatchingNode($nodequery, &$node) {
		$nodelist = $this->tpath->query($this->XMLFunctions->buildNodeQuery($nodequery, false, true));
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
				$this->displayNodeList($nodelist);
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

	function displayNode(\DOMNode $node) {
		switch ($node->nodeType) {
			case XML_TEXT_NODE:
				//debug($node->wholeText);
				break;
			default:
				$debug_xml = new \DOMDocument();
				$child = $debug_xml->importNode($node);
				$debug_xml->appendChild($child);
				//debug(Xml::toArray($debug_xml));
				unset($debug_xml);
		}
	}

	function displayNodeList(\DOMNodeList $nodelist) {
		$debug_xml = new \DOMDocument();
		for ($i = 0; $i < $nodelist->length; $i++) {
			$debugnode = $nodelist->item($i);
			var_dump($debugnode->attributes);
			$child = $debug_xml->importNode($debugnode);
			$child->setAttribute('nodeType', $child->nodeType);
			$debug_xml->appendChild($child);
		}
		//debug(Xml::toArray($debug_xml));
		unset($debug_xml);
	}

	function standardizeTemplate(&$domdocument) {
		debug('Standardizing Template');
		$update = [
			'PERKS' => 'PERK',
			'TALENTS' => 'TALENT',
			'SKILLS' => 'SKILL',
			'DISADVANTAGES' => 'DISAD',
			'POWERS' => 'POWER'
		];
		foreach ($update as $ukey => $uvalue) {
			$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery("/HEROCSHEET/$ukey"));
//			debug($nodelist->length);
			$this->templateNodesToTag($nodelist, $uvalue);
		}
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('/HEROCSHEET/MARTIAL_ARTS'));
		$this->templateXmlidToDisplay($nodelist, 'MANEUVER');
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('/HEROCSHEET/CHARACTERISTICS'));
//		debug($nodelist->length);
		$this->templateXmlidToDisplay($nodelist);
		$nodelist = $this->XMLFunctions->getNodeList($domdocument, $this->XMLFunctions->buildNodeQuery('//TYPE',false,false));
//		$this->XMLFunctions->displayNodeList($nodelist);
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
				$this->XMLFunctions->renameElement($node, $node->getAttribute('XMLID'), false);
			}
		}
	}

	function templateXmlidToDisplay($nodelist, $name = null) {
		foreach ($nodelist as $node) {
//			debug($node->nodeName);
			if (!$name || $node->nodeName == $name) {
//				debug($this->XMLFunctions->cleanStringForTagName($node->getAttribute('DISPLAY')));
				$node->setAttribute('XMLID', $this->XMLFunctions->cleanStringForTagName($node->getAttribute('DISPLAY')));
//				debug($node->getAttribute('XMLID'));
			}
		}
	}

	function templateXmlidToNodeValue($nodelist) {
		foreach ($nodelist as $node) {
			if ($node->nodeType == XML_TEXT_NODE) {
				$node->parentNode->setAttribute('XMLID', $this->XMLFunctions->cleanStringForTagName($node->nodeValue));
			} else {
//				debug('Should be a text node: ' . $node->nodeType);
//				$this->XMLFunctions->displayNode($node);
			}
		}
	}


}
