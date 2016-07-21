<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Xml;

/**
 * PMergeCharacter component
 */
class PMergeCharacterComponent extends Component {

	public $components = ['Vorien/HeroCSheet.PNodeStack'];
	public $basequery = 'HEROCSHEET';
	public $character_xml;
	public $merged_xml;
	public $cpath;
	public $tpath;
	public $idattribute = 'XMLID';
	public $errorstack = [];
	public $nodestack = [];

	public function initialize(array $config) {
		parent::initialize($config);
		$this->character_xml = new \DOMDocument();
		$this->character_xml->preserveWhiteSpace = false;
		$this->character_xml->loadXML($config['character_xml']->saveXML());
		$this->cpath = new \DOMXPath($this->character_xml);
		$this->merged_xml = new \DOMDocument();
		$this->merged_xml->preserveWhiteSpace = false;
		$this->merged_xml->loadXML($config['merged_xml']->saveXML());
		$this->tpath = new \DOMXPath($this->merged_xml);
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
//		$xquery = "/HEROCSHEET/SKILLS/SKILL[@XMLID = 'GAMBLING']/ADDER[@XMLID = 'SPORTSBETTING' and @XMLID = 'FANDOM']/ADDER[@XMLID = 'STEELBALL']";
//		$xquery = 'HEROCSHEET';
//		debug($xquery);
//		$nodestack = $this->PNodeStack->parseNodeString($xquery);
//		debug($nodestack);
//		$xquery = $this->PNodeStack->buildNodeString($nodestack);
//		debug($xquery);
//		die(' ');
	}

	function runMatchingTests(&$nodestack, &$node, $checkmodifier = false) {
		if (!($matchednode = $this->getMatchingNode($nodestack))) { //Exact match
			if (!($matchednode = $this->testWithOption($nodestack, $node))) {// Match OPTION child node
				if (!($matchednode = $this->testWithInjectOption($nodestack, $node))) {// Parent has OPTION before node
					if ($checkmodifier && $this->PNodeStack->findInStack($nodestack, 'MODIFIER') && !($matchednode = $this->checkInModifiersNodePath($nodestack, $node))) {
						return false;
					}
				}
			}
		}
		return $matchednode;
	}

	function getMatchingNode(&$nodestack) {
		$nodequery = $this->PNodeStack->buildNodeString($nodestack, true);
		$nodelist = $this->tpath->query($nodequery);
		switch ($nodelist->length) {
			case 0:
				// No match found, return to caller for processing
//					debug($nodestack);
					$this->errorstack[] = $nodequery;
				return false;
				break;
			case 1:
				// Match found, return matching node in $xpath
				return $nodelist->item(0);
				break;
			default:
				// This means that there are multiple matching tag/xmlid combinations
				// TODO Handle multiple matches.  It looks like they're all empty nodes
				$this->errorstack[] = 'Multiple tag/xmlid matches found';
				$this->errorstack[] = 'nodelist length: ' . $nodelist->length;
				$this->errorstack[] = $this->PNodeStack->buildNodeString($nodestack, $usebrackets, true);
				$this->errorstack[] = $nodestack;
				$this->showErrorStack();
				die(' ');
				break;
		}
	}

	function testWithOption(&$nodestack, &$node) {
			if ($node->hasAttribute('OPTIONID')) {
				$optionstack = $nodestack;
				$optionstack[] = [
					'tag' => 'OPTION',
					['@' . $this->idattribute . " = '" . $node->getAttribute('OPTIONID') . "'"]
				];
				if ($matchednode = $this->getMatchingNode($optionstack)) {
					return $matchednode;
//				} else {
//					debug($optionstack);
//					debug($this->PNodeStack->buildNodeString($optionstack, true));
				}
			}
		return false;
	}

	function testWithInjectOption(&$nodestack, &$node) {
		if ($optionstack = $this->injectOptionNode($nodestack, $node)) {
			if ($matchednode = $this->getMatchingNode($optionstack)) { // Match parent/OPTION/node
				return $matchednode;
//			} else {
//				debug($optionstack);
//				debug($this->PNodeStack->buildNodeString($optionstack, true));
			}
		}
		return false;
	}

	function mergeCharacter($nodestack = null, $depth = 0) {
		if (!$nodestack) {
			$nodestack = $this->PNodeStack->parseNodeString($this->basequery);
		}
		$nodelist = $this->cpath->query($this->PNodeStack->buildNodeString($nodestack, true));
		foreach ($nodelist as $node) {
			if ($matchednode = $this->runMatchingTests($nodestack, $node, true)) {
				$this->errorstack = [];
//				$this->displayText('Match found', $node->getNodePath(), $matchednode->getNodePath());
				$success = $this->updateAttributes($node, $matchednode);
			} else {
				$errorstack[] = 'No matching node found';
//				debug('nodeType (3 is TEXT): ' . $node->nodeType);
//				debug($optionstack);
				$errorstack[] = $nodestack;
//				debug($this->PNodeStack->buildNodeString($nodestack,false, true));
				$this->showErrorStack();
				die();
			}
			if ($node->hasChildNodes()) {
				foreach ($node->childNodes as $child) {
					if ($child->nodeType == XML_TEXT_NODE || $child->nodeName == 'NOTES') {
//						debug('Text Node');
//						$this->displayNode($child);
						//TODO Compare text, then ?
					} else {
						$childstack = $this->PNodeStack->addQueryLevel($nodestack, $child, [$this->idattribute]);
//						debug($childstack);
						$this->mergeCharacter($childstack, $depth + 1);
					}
				}
			}
		}
		return $this->character_xml;
	}

	function checkInModifiersNodePath(&$nodestack, &$node) {
		if ($modifierstack = $this->PNodeStack->getRebasedNodeStack($nodestack, 'MODIFIER', '/HEROCSHEET/MODIFIERS')) {
			$this->errorstack[] = $modifierstack;
			$matchednode = $this->runMatchingTests($modifierstack, $node);
			if($matchednode){
				$this->errorstack[] = $matchednode->getNodePath();
			}
			return $matchednode;
		} else {
			return false;
//			$this->displayText('MODIFIER IN PATH, getRebasedNodeStack failed, prepath: MODIFIER, /HEROCSHEET/MODIFIERS', null, null);
//			die(' ');
		}
	}

	function updateAttributes(&$tonode, &$fromnode) {
		if (!$tonode->hasAttributes() || !$fromnode->hasAttributes()) {
			return 'No Attributes to merge';
		}
		if ($tonode->nodeType == XML_TEXT_NODE || $fromnode->nodeType == XML_TEXT_NODE) {
			return 'One or both are TEXT nodes';
		}
//		$this->displayAttributes($fromnode);
//		$this->displayAttributes($tonode);
		foreach ($fromnode->attributes as $attribute) {
//			if(!$tonode->hasAttribute($attribute->name)){
			$tonode->setAttribute($attribute->name, $attribute->value);
//			}
		}
//		$this->displayAttributes($tonode);
		return 'Success';
	}

	function injectOptionNode(&$nodestack, &$node) {
			if ($node->parentNode) {
				$parentnode = $node->parentNode;
				if ($parentnode->hasAttribute('OPTIONID')) {
					$newstack = $nodestack;
					$lastlevel = array_pop($newstack);
					$newstack[] = [
						'tag' => 'OPTION',
						['@' . $this->idattribute . " = '" . $parentnode->getAttribute('OPTIONID') . "'"]
					];
					array_push($newstack, $lastlevel);
					return $newstack;
				} else {
//					debug('Parent node has no option id');
				}
			} else {
				debug('Matched node has no parent node');
			}
		return false;
	}

//	function addOptionsToAdderPath($nodestack) {
//		$startchar = strpos($nodestack, '/ADDER');
//		$nodestack = substr_replace($nodquery, '', $pos, 0);
//		if ($node->hasAttribute('OPTIONID') && $node->getAttribute('OPTIONID')) {
//			$optionnode = $node->ownerDocument->createElement("OPTION");
//			$optionnode->setAttribute('XMLID', $node->getAttribute('OPTIONID'));
//			$node->appendChild($optionnode);
//			debug('Added option node to: ' . $node->nodeName);
//		}
//
//		$nodestack = $basequery . substr($nodestack, $startchar);
////		debug($nodestack);
//		return $nodestack;
//	}
//
//	function displayText($message, $nodestack, $matchednodepath, $error = false) {
//		$msg = $message . ' - nodepath: ';
//		$msg .= $nodestack;
//		if ($matchednodepath) {
//			$msg .= ' -> matching nodepath: ' . $matchednodepath;
//		}
//		if ($error) {
//			$msg = '<h2>' . $msg . '</h2>';
//		}
//		debug($msg);
//	}
//
//	function getLowestMatchingParent($nodestack, $node) {
//		do {
//			$gmn = $this->getMatchingNode($nodestack, $node);
//			if ($node->parentNode) {
//				$node = $node->parentNode;
//				$nodestack = $this->removeQueryLevel($nodestack);
//			} else {
//				return false;
//			}
//		} while (!$gmn);
//		return $gmn;
//	}

	function displayNode(\DOMNode $node) {
		switch ($node->nodeType) {
			case XML_TEXT_NODE:
				debug($node->wholeText);
				break;
			default:
				$debug_xml = new \DOMDocument();
				$child = $debug_xml->importNode($node);
				$debug_xml->appendChild($child);
				debug(Xml::toArray($debug_xml));
				unset($debug_xml);
		}
	}

	function displayNodeList(\DOMNodeList $nodelist) {
//		$debug_xml = new \DOMDocument();
		for ($i = 0; $i < $nodelist->length; $i++) {
			debug($nodelist->item($i)->nodeType);
			debug($nodelist->item($i)->getNodePath());
			$this->displayNode($nodelist->item($i));
//			$debugnode = $nodelist->item($i);
//			$child = $debug_xml->importNode($debugnode);
//			$child->setAttribute('nodeType', $child->nodeType);
//			$debug_xml->appendChild($child);
		}
//		debug(Xml::toArray($debug_xml));
//		unset($debug_xml);
	}

	function displayAttributes(&$node) {
		echo '<b>', $node->nodeName, '</b><br>';
		if ($node->attributes) {
			foreach ($node->attributes as $attribute) {
				echo $attribute->name, ': ', $attribute->value, '<br>';
			}
		} else {
			debug('child has no attributes: ' . $node->nodeName);
		}
	}

	function showErrorStack(){
		foreach($this->errorstack as $error){
			debug($error);
		}
		$this->errorstack = [];
	}
}
