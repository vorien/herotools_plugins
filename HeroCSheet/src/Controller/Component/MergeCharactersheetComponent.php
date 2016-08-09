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
	public $basequery = '/';
	public $to_xml;
	public $to_path;
	public $from_xml;
	public $from_path;
	public $rules;
	public $idattribute = 'ID';
	public $errorstack = [];
	public $NodeStack;
	public $XMLFunctions;

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
		$this->to_xml->preserveWhiteSpace = false;
		$this->to_xml->loadXML($config['character_xml']->saveXML());
		$this->XMLFunctions->renameElement($this->to_xml->documentElement, 'HEROCSHEET');
		$this->moveEnhancers();
		$this->XMLFunctions->removeEmptyTags($this->to_xml);
		$this->to_path = new \DOMXPath($this->to_xml);
		$this->from_xml = new \DOMDocument();
		$this->from_xml->preserveWhiteSpace = false;
		$this->from_xml->loadXML($config['merged_xml']->saveXML());
		$this->XMLFunctions->removeEmptyTags($this->from_xml);
		$this->from_path = new \DOMXPath($this->from_xml);

		$rules_xml = new \DOMDocument();
		$rules_xml->preserveWhiteSpace = false;
		$rules_xml->loadXML($config['rules_xml']->saveXML());
		$this->rules = $this->XMLFunctions->getAttributesAsArray($rules_xml->documentElement);
	}

	public function addPerceptionSkill() {
		$attributes = [
			'XMLID' => 'PERCEPTION',
			'SHOWDIALOG' => 'No',
			'DISPLAY' => 'Perception',
			'MINCOST' => '0',
			'EXCLUSIVE' => 'Yes',
			'CHARACTERISTIC' => 'INT',
			'BASECOST' => '0',
			'LVLCOST' => '3',
			'LVLVAL' => '1',
			'ID' => '1351803027794',
			'LEVELS' => '0',
			'ALIAS' => 'Perception',
			'POSITION' => '28',
			'MULTIPLIER' => '1.0',
			'GRAPHIC' => 'Burst',
			'COLOR' => '255 255 255',
			'SFX' => 'Default',
			'SHOW_ACTIVE_COST' => 'No',
			'INCLUDE_NOTES_IN_PRINTOUT' => 'No',
			'FAMILIARITY' => 'No',
			'PROFICIENCY' => 'No',
			'LEVELSONLY' => 'No',
			'DEFINITION' => 'This skill is used to perceive their surroundings.'
		];
		$skillsnode = $this->to_xml->getElementsByTagName('SKILLS')->item(0);
		$node = $this->XMLFunctions->attachElement($skillsnode, 'SKILL', $attributes);
//		$this->XMLFunctions->displayNode($node);
	}

	public function moveEnhancers() {
		$skillsnode = $this->to_xml->getElementsByTagName('SKILLS')->item(0);
		$nodepath = $skillsnode->getNodePath();
		$tagsremovedcount = $this->XMLFunctions->removeTags($this->to_xml, $nodepath . $this->XMLFunctions->buildSkipEmptyNodes(['starts-with(name(),"HYKERU")']));
		if ($movednodes = $this->XMLFunctions->moveNodes($this->to_xml, '/HEROCSHEET/SKILL_ENHANCERS', $skillsnode, $this->XMLFunctions->buildSkipEmptyNodes(['not(self::SKILL)']))) {
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

	function mergeCharacter($nodestack = null, $depth = 0) {
		$this->errorstack[] = 'mergeCharacter';
		if (!$nodestack) {
			$nodestack = $this->NodeStack->parseNodeString($this->basequery);
		}
		$nodequery = $this->NodeStack->buildNodeString($nodestack) . $this->XMLFunctions->buildSkipEmpty();
		$nodelist = $this->to_path->query($nodequery);
		foreach ($nodelist as $node) {
//			debug($node->nodeName);
			if (!$this->ignorenode($node)) {
//				debug($nodestack);
				if ($matchednode = $this->runMatchingTests($nodestack, $node, true)) {
					$updated = $this->updateAttributes($node, $matchednode);
//					debug('Updating attributes for: ' . $node->getNodePath() . ' reported ' . $updated);
					$this->errorstack = [];
				} else {
					$errorstack[] = 'No matching node found';
//					debug('nodeType (3 is TEXT): ' . $node->nodeType);
					$errorstack[] = $nodestack;
//					$this->showErrorStack();
//					die('No matching node found');
				}
				$this->addMaximaAsAttribute($node);
				if ($node->hasChildNodes()) {
					foreach ($node->childNodes as $child) {
						if ($child->nodeType == XML_TEXT_NODE || $child->nodeName == 'NOTES') {
//							debug('Text Node');
//							debug($child->nodeName);
//							debug($child->hasAttributes());
//							$this->XMLFunctions->displayNode($child);
							//TODO Compare text, then ?
						} else {
							$childstack = $this->NodeStack->addQueryLevel($nodestack, $child, [$this->idattribute]);
							$this->mergeCharacter($childstack, $depth + 1);
						}
					}
				}
			}
		}
		return $this->to_xml;
	}

	function runMatchingTests(&$nodestack, &$node, $checkmodifier = false) {
		$this->errorstack[] = 'runMatchingTests';
		if (!($matchednode = $this->getMatchingNode($nodestack))) { //Exact match
			if (!($matchednode = $this->testWithOption($nodestack, $node))) {// Match OPTION child node
				if (!($matchednode = $this->testWithInjectOption($nodestack, $node))) {// Parent has OPTION before node
					if ($checkmodifier && $this->NodeStack->findInStack($nodestack, 'MODIFIER') && !($matchednode = $this->checkInModifiersNodePath($nodestack, $node))) {
						return false;
					} else {
//						debug('Found using checkInModifiersNodePath');
//						debug($node->getAttribute($this->idattribute) . ' -> ' . $matchednode->getAttribute($this->idattribute));
					}
				} else {
//					debug('Found using testWithInjectOption');
//					debug($node->getAttribute($this->idattribute) . ' -> ' . $matchednode->getAttribute($this->idattribute));
				}
			} else {
//				debug('Found using testWithOption');
//				debug($node->getAttribute($this->idattribute) . ' -> ' . $matchednode->getAttribute($this->idattribute));
			}
		} else {
//			debug('Found using getMatchingNode');
//			debug($node->getAttribute($this->idattribute) . ' -> ' . $matchednode->getAttribute($this->idattribute));
		}
		return $matchednode;
	}

	function getMatchingNode(&$nodestack) {
		$this->errorstack[] = 'getMatchingNode';
		$nodequery = $this->NodeStack->buildNodeString($nodestack);
//		debug($nodequery);
		$nodelist = $this->from_path->query($nodequery);
		switch ($nodelist->length) {
			case 0:
				// No match found, return to caller for processing
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
				die('Multiple tag/xmlid matches found');
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
//			} else {
//				debug($optionstack);
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
//			die('getRebasedNodeStack failed');
		}
	}

	function updateAttributes(&$tonode, &$fromnode) {
		$this->errorstack[] = 'updateAttributes';
		if (!$tonode->hasAttributes() || !$fromnode->hasAttributes()) {
			return 'No Attributes to merge';
		}
		if ($tonode->nodeType == XML_TEXT_NODE || $fromnode->nodeType == XML_TEXT_NODE) {
			return 'One or both are TEXT nodes';
		}
		foreach ($fromnode->attributes as $attribute) {
			if (!$tonode->hasAttribute($attribute->name)) {
				$tonode->setAttribute($attribute->name, $attribute->value);
			}
		}
		$this->addDefinitionAsAttribute($tonode, $fromnode);
		return 'Success';
	}

	function addDefinitionAsAttribute(&$node, &$matchednode) {
		if ($childnode = $this->XMLFunctions->getFirstMatchingChild($matchednode, 'DEFINITION')) {
			$cleanedvalue = preg_replace('/[\t|\r|\n]/', '', $childnode->nodeValue);
			$node->setAttribute('DEFINITION', $cleanedvalue);
//			var_dump($childnode);
//				$this->XMLFunctions->copyNode($node, $childnode);
			return true;
		}
		return false;
	}

	function addMaximaAsAttribute(&$node) {
		if ($node->nodeName == 'SKILL' && ($characteristic = $this->XMLFunctions->getAttributeValue($node, 'CHARACTERISTIC'))) {
			if ($this->rules['USESKILLMAXIMA'] == 'Yes') {
				$node->setAttribute('SKILLMAXIMALIMIT', $this->rules['SKILLMAXIMALIMIT']);
			}
			if ($characteristic != 'GENERAL') {
				$node->setAttribute('SKILLROLLBASE', $this->rules['SKILLROLLBASE']);
				$node->setAttribute('SKILLROLLDENOMINATOR', $this->rules['SKILLROLLDENOMINATOR']);
			}
		}
		if ($node->parentNode->nodeName == 'CHARACTERISTICS') {
			$node->setAttribute('CHARACTERISTICMAXIMA', $this->rules[$node->nodeName . '_MAX']);
			if (in_array($this->XMLFunctions->getAttributeValue($node, $this->idattribute), ['STR', 'DEX', 'CON', 'INT', 'EGO', 'PRE'])) {
				$node->setAttribute('CHARROLLBASE', $this->rules['CHARROLLBASE']);
				$node->setAttribute('CHARROLLDENOMINATOR', $this->rules['CHARROLLDENOMINATOR']);
			}
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
//				debug('Parent node has no option id');
			}
		} else {
			$this->errorstack[] = 'Matched node has no parent node';
		}
		return false;
	}

	function showErrorStack() {
		foreach ($this->errorstack as $error) {
			debug($error);
		}
		$this->errorstack = [];
	}

}
