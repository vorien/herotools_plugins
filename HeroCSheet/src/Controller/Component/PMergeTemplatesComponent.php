<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Xml;

/**
 * PMergeTemplates component
 */
class PMergeTemplatesComponent extends Component {

	public $skipemptynodes = '/node()[not(self::text()[not(normalize-space())])]';
	public $skipempty = '[not(self::text()[not(normalize-space())])]';
	public $basequery = '//*' . '/node()[not(self::text()[not(normalize-space())])]';
	public $merge_xml;
	public $tpath;
	public $fpath;
	public $idattribute = 'XMLID';

	public function initialize(array $config) {
		parent::initialize($config);
		$this->merge_xml = new \DOMDocument();
		$this->merge_xml->loadXML($config['to_xml']->saveXML());
		$this->from_xml = new \DOMDocument();
		$this->from_xml->loadXML($config['from_xml']->saveXML());
		$this->tpath = new \DOMXPath($this->merge_xml);
		$this->fpath = new \DOMXPath($config['from_xml']);
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
	}

	function mergeTemplates($nodequery = null, $depth = 0) {
		if (!$nodequery) {
			$nodequery = $this->basequery;
		}
		$nodelist = $this->fpath->query($this->attachEmptyFilter($nodequery));
		if($nodelist->length != 1) {
			//debug("More than one node in nodelist: " . $this->attachEmptyFilter($nodequery) . " - Qty: " . $nodelist->length);
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
							//debug('Text Node');
							$this->displayNode($child);
							//TODO Compare text, then ?
						} else {
							$childnodequery = $this->addQueryLevel($nodequery, $child);
							$this->mergeTemplates($childnodequery, $depth + 1);
						}
					}
				}
//				$node->parentNode->removeChild($node);
				return $this->merge_xml;
		}
		
	function attachEmptyFilter($nodequery) {
		$nodequery .= $this->skipempty;
		return $nodequery;
	}

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
		$nodelist = $this->tpath->query($this->attachEmptyFilter($nodequery));
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
				//debug('Multiple tag/xmlid matches found: ' . $nodequery);
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

}
