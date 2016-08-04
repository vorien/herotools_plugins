<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
//use Cake\Utility\Xml;
use Cake\Core\App;

//
require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'NodeStack.php');
require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'XMLFunctions.php');

use NodeStack;
use XMLFunctions;

/**
 * MergeCharactersheetComponent component
 */
class MergeCharactersheetComponent extends Component {

	public $components = [];
	public $basequery = 'HEROCSHEET';
	public $character_xml;
	public $rules;
	public $merged_xml;
	public $cpath;
	public $tpath;
	public $idattribute = 'XMLID';
	public $errorstack = [];
	public $NodeStack;
	public $XMLFunctions;

	public function setConfiguration(array $config) {
		$this->NodeStack = new NodeStack();
		$this->XMLFunctions = new XMLFunctions();

		$this->character_xml = new \DOMDocument();
		$this->character_xml->preserveWhiteSpace = false;
		$this->character_xml->loadXML($config['character_xml']->saveXML());
		$this->XMLFunctions->renameElement($this->character_xml->documentElement, 'HEROCSHEET');
		$this->moveEnhancers($this->character_xml);
//		$this->XMLFunctions->removeEmptyTags($this->character_xml);
		$this->cpath = new \DOMXPath($this->character_xml);
		$this->merged_xml = new \DOMDocument();
		$this->merged_xml->preserveWhiteSpace = false;
		$this->merged_xml->loadXML($config['merged_xml']->saveXML());
		$this->XMLFunctions->removeEmptyTags($this->merged_xml);
		$this->tpath = new \DOMXPath($this->merged_xml);

		$rules_xml = new \DOMDocument();
		$rules_xml->preserveWhiteSpace = false;
		$rules_xml->loadXML($config['rules_xml']->saveXML());
		$this->rules = $this->XMLFunctions->getAttributesAsArray($rules_xml->documentElement);

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
//		$nodestack = $this->NodeStack->parseNodeString($xquery);
//		debug($nodestack);
//		$xquery = $this->NodeStack->buildNodeString($nodestack);
//		debug($xquery);
//		die(' ');
	}

	public function moveEnhancers(&$cxml) {
		$skillsnode = $cxml->getElementsByTagName('SKILLS')->item(0);
		$nodepath = $skillsnode->getNodePath();
		$tagsremovedcount = $this->XMLFunctions->removeTags($cxml, $nodepath . $this->XMLFunctions->buildSkipEmptyNodes(['starts-with(name(),"HYKERU")']));
		if ($movednodes = $this->XMLFunctions->moveNodes($cxml, '/HEROCSHEET/SKILL_ENHANCERS', $skillsnode, $this->XMLFunctions->buildSkipEmptyNodes(['not(self::SKILL)']))) {
			$this->XMLFunctions->renameElements($movednodes, 'ENHANCER');
			return $movednodes;
		} else {
			//Either there was an error (null), or there were no Elements to move
			return $movednodes;
		}
	}

	function ignoreNode(&$node) {
		if ($node->hasAttribute($this->idattribute) && $node->getAttribute($this->idattribute) == 'MAKEASENSE') {
			return true;
		} else {
			return false;
		}
	}

	function addDefinitionAsAttribute(&$node, &$matchednode) {
		if ($childnode = $this->XMLFunctions->getFirstMatchingChild($matchednode, 'DEFINITION')) {
			debug($node->nodeName);
			$cleanedvalue = preg_replace('/[\t|\r|\n]/', '', $childnode->nodeValue);
			$node->setAttribute('DEFINITION', $cleanedvalue);
//			var_dump($childnode);
//				$this->XMLFunctions->copyNode($node, $childnode);
			return true;
		}
		return false;
	}

	function mergeCharacter($nodestack = null, $depth = 0) {
		$this->errorstack[] = 'mergeCharacter';
		if (!$nodestack) {
			$nodestack = $this->NodeStack->parseNodeString($this->basequery);
		}
		$nodelist = $this->cpath->query($this->NodeStack->buildNodeString($nodestack, true));
		foreach ($nodelist as $node) {
			debug($node->nodeName);
			if (!$this->ignorenode($node)) {
				if ($matchednode = $this->runMatchingTests($nodestack, $node, true)) {
//				$this->displayText('Match found', $node->getNodePath(), $matchednode->getNodePath());
					$this->updateAttributes($node, $matchednode);
					$this->errorstack = [];
				} else {
					$errorstack[] = 'No matching node found';
//				debug('nodeType (3 is TEXT): ' . $node->nodeType);
//				debug($optionstack);
					$errorstack[] = $nodestack;
//				debug($this->NodeStack->buildNodeString($nodestack,false, true));
//				$this->showErrorStack();
//				die();
				}
				$this->addMaximaAsAttribute($node);
				if ($node->hasChildNodes()) {
					foreach ($node->childNodes as $child) {
						if ($child->nodeType == XML_TEXT_NODE || $child->nodeName == 'NOTES') {
//							debug('Text Node');
//							debug($child->nodeName);
//							debug($child->hasAttributes());
//						$this->XMLFunctions->displayNode($child);
							//TODO Compare text, then ?
						} else {
							$childstack = $this->NodeStack->addQueryLevel($nodestack, $child, [$this->idattribute]);
//						debug($childstack);
							$this->mergeCharacter($childstack, $depth + 1);
						}
					}
				}
			}
		}
		return $this->character_xml;
	}

	function runMatchingTests(&$nodestack, &$node, $checkmodifier = false) {
		debug($nodestack);
		$this->errorstack[] = 'runMatchingTests';
		if (!($matchednode = $this->getMatchingNode($nodestack))) { //Exact match
			if (!($matchednode = $this->testWithOption($nodestack, $node))) {// Match OPTION child node
				if (!($matchednode = $this->testWithInjectOption($nodestack, $node))) {// Parent has OPTION before node
					if ($checkmodifier && $this->NodeStack->findInStack($nodestack, 'MODIFIER') && !($matchednode = $this->checkInModifiersNodePath($nodestack, $node))) {
						return false;
					}
				}
			}
		}
		return $matchednode;
	}

	function getMatchingNode(&$nodestack) {
		$this->errorstack[] = 'getMatchingNode';
		$nodequery = $this->NodeStack->buildNodeString($nodestack, true);
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
				$this->errorstack[] = $nodequery;
				$this->errorstack[] = $nodestack;
				$this->showErrorStack();
				die(' ');
				break;
		}
	}

	function testWithOption(&$nodestack, &$node) {
		$this->errorstack[] = 'testWithOption';
		if ($node->hasAttribute('OPTIONID')) {
			$optionstack = $nodestack;
			$optionstack[] = [
				'tag' => 'OPTION',
				'attributes' => ['@' . $this->idattribute . " = '" . $node->getAttribute('OPTIONID') . "'"]
			];
			if ($matchednode = $this->getMatchingNode($optionstack)) {
				return $matchednode;
//				} else {
//					debug($optionstack);
//					debug($this->NodeStack->buildNodeString($optionstack, true));
			}
		}
		return false;
	}

	function testWithInjectOption(&$nodestack, &$node) {
		$this->errorstack[] = 'testWithInjectOption';
		if ($optionstack = $this->injectOptionNode($nodestack, $node)) {
			if ($matchednode = $this->getMatchingNode($optionstack)) { // Match parent/OPTION/node
				return $matchednode;
//			} else {
//				debug($optionstack);
//				debug($this->NodeStack->buildNodeString($optionstack, true));
			}
		}
		return false;
	}

	function checkInModifiersNodePath(&$nodestack, &$node) {
		$this->errorstack[] = 'checkIntModifiersNodePath';
		if ($modifierstack = $this->NodeStack->getRebasedNodeStack($nodestack, 'MODIFIER', '/HEROCSHEET/MODIFIERS')) {
			$this->errorstack[] = $modifierstack;
			$matchednode = $this->runMatchingTests($modifierstack, $node);
			if ($matchednode) {
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
//		debug($tonode->getNodePath());
//		debug($fromnode->getNodePath());
		$this->errorstack[] = 'updateAttributes';
		if (!$tonode->hasAttributes() || !$fromnode->hasAttributes()) {
			return 'No Attributes to merge';
		}
		if ($tonode->nodeType == XML_TEXT_NODE || $fromnode->nodeType == XML_TEXT_NODE) {
			return 'One or both are TEXT nodes';
		}
//		$this->displayAttributes($fromnode, 'updateAttributes');
//		$this->displayAttributes($tonode, 'updateAttributes');
		foreach ($fromnode->attributes as $attribute) {
//			if(!$tonode->hasAttribute($attribute->name)){
			$tonode->setAttribute($attribute->name, $attribute->value);
//			}
		}
		$this->addDefinitionAsAttribute($tonode, $fromnode);
//		$this->displayAttributes($tonode, 'updateAttributes');
		return 'Success';
	}

	function addMaximaAsAttribute(&$node) {
		if ($node->nodeName == 'SKILL' && $this->rules['USESKILLMAXIMA'] == 'Yes') {
			$node->setAttribute('SKILLMAXIMA', $this->rules['SKILLMAXIMALIMIT']);
		}
		if ($node->parentNode->nodeName == 'CHARACTERISTICS') {
			$node->setAttribute('CHARACTERISTICMAXIMA', $this->rules[$node->nodeName . '_MAX']);
		}
	}

	function injectOptionNode(&$nodestack, &$node) {
		$this->errorstack[] = 'injectOptionNode';
		if ($node->parentNode) {
			$parentnode = $node->parentNode;
			if ($parentnode->hasAttribute('OPTIONID')) {
				$newstack = $nodestack;
				$lastlevel = array_pop($newstack);
				$newstack[] = [
					'tag' => 'OPTION',
					'attributes' => ['@' . $this->idattribute . " = '" . $parentnode->getAttribute('OPTIONID') . "'"]
				];
				array_push($newstack, $lastlevel);
				return $newstack;
			} else {
//					debug('Parent node has no option id');
			}
		} else {
			$this->errorstack[] = 'Matched node has no parent node';
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

	function showErrorStack() {
		foreach ($this->errorstack as $error) {
			debug($error);
		}
		$this->errorstack = [];
	}

}
