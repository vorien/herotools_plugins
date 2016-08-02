<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Utility\Xml;
use Cake\Core\App;

//
require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'XMLFunctions.php');

use XMLFunctions;

//use App\Plugins\Vorien\HeroCSheet\Lib\NodeStack;
/**
 * PMergeCharacter component
 */
class PProcessCharacterComponent extends Component {

	public $XMLFunctions;
	public $errorstack = [];
	public $character_xml;
	public $rolluparray = ['cost' => 0, 'add' => 0, 'plus' => 0, 'minus' => 0, 'alias' => '', 'attributes' => []];

	public function initialize(array $config) {
		parent::initialize($config);
		$this->XMLFunctions = new XMLFunctions();
		$this->character_xml = new \DOMDocument();
		$this->character_xml->preserveWhiteSpace = false;
		$this->character_xml->formatOutput = true;
		$this->character_xml->loadXML($config['character_xml']->saveXML());
	}

	function processCharacter($query = null, $depth = 0) {
		$rollup = $this->rolluparray;
		if (!$query) {
			$query = $this->character_xml->documentElement->getNodePath();
//			$query = '/HEROCSHEET/POWERS/POWER[@XMLID = "DARKNESS"]';
		}
		$nodelist = $this->XMLFunctions->getNodeList($this->character_xml, $query . $this->XMLFunctions->buildSkipEmpty());
		if ($nodelist->length == 1) {
			$node = $nodelist->item(0);
		} else {
			die('Multiple nodes found: ' . $query . ' returned -> ' . $nodelist->length . ' nodes');
		}
		$rollup['cost'] = $this->getCost($node);
		$rollup['attributes'] = $this->getSelectedAttributes($node);
		if ($node->hasChildNodes()) {
			foreach ($node->childNodes as $child) {
				if ($child->nodeType != XML_TEXT_NODE && $child->nodeName != 'text()') {
					$this->combineRollupArrays($rollup, $this->processCharacter($child->getNodePath(), $depth + 1));
				}
			}
			$this->applyCalcs($rollup);
			$this->clearCalcs($rollup);
		}
		// Set rollup values from current node
		switch ($node->nodeName) {
			case 'ADDER':
				$rollup['add'] = $rollup['cost'];
				break;
			case 'MODIFIER':
				if ($rollup['cost'] < 0) {
					$rollup['minus'] = $rollup['cost'];
				} else {
					$rollup['plus'] = $rollup['cost'];
				}
				break;
			default:
				if ($node->hasAttribute('XMLID')) {
					echo $rollup['cost'], ',', $node->getAttribute('ALIAS'), ',', $node->getAttribute('INPUT'), ',', $node->getAttribute('XMLID'), '<br>';
					debug($rollup);
//					$this->displayAttributes($node);
				} else {
//					debug($node->getNodePath());
				}
				break;
		}
		return $rollup;
	}

	function getSelectedAttributes(&$node){
		$return = [];
		$attributelist = [
			'ALIAS',
			'DISPLAY',
			'NAME',
			'DEFINITION',
			'XMLID',
			'OPTION_ALIAS',
			'LEVELS',
			'LVLVAL',
			'LEVELVAL',
			'BASE',
			'BASECOST',
			'FAMILIARITY',
			'PROFICIENCY',
			'CHARACTERISTIC',
			'NOTES',
			'SKILLMAXIMA',
			'CHARACTERISTICMAXIMA'
		];
		foreach($attributelist as $attribute){
			if($add = $this->XMLFunctions->getAttributeValue($node, $attribute)){
				$return[$attribute] = $add;
			}
		}
			if(($characteristic = $this->XMLFunctions->getAttributeValue($node, 'CHARACTERISTIC')) && $characteristic != 'GENERAL'){
				if(($nodelist = $this->XMLFunctions->getNodeList($node->ownerDocument, '/HEROCSHEET/CHARACTERISTICS/' . $characteristic)) && $nodelist->length == 1){
					$characteristicnode = $nodelist->item(0);
					$return['CHARACTERISTICVALUE'] = $characteristicnode->getAttribute('BASE') +  $characteristicnode->getAttribute('LEVELS');
					$return['CHARACTERISTICMAXIMA'] = $characteristicnode->getAttribute('CHARACTERISTICMAXIMA');
				}
			}
		
		return $return;
	}
	
	function clearCalcs(&$rollup) {
		$rollup['add'] = $rollup['plus'] = $rollup['minus'] = 0;
	}

	function applyCalcs(&$rollup) {
		$rollup['cost'] = ($rollup['cost'] + $rollup['add']) * (1 + $rollup['plus']) / (1 - $rollup['minus']);
	}

	function combineRollupArrays(&$rollup, $combinerollup) {
		$rollup['add'] += $combinerollup['add'];
		$rollup['plus'] += $combinerollup['plus'];
		$rollup['minus'] += $combinerollup['minus'];
		$rollup['attributes'][] = $combinerollup['attributes'];
	}

	function getCost(&$node) {
		$basecost = $this->XMLFunctions->getAttributeValue($node, 'BASECOST');
		$levels = $this->XMLFunctions->getAttributeValue($node, 'LEVELS');
		$levelstart = $this->XMLFunctions->getAttributeValue($node, 'LEVELSTART');
		$lvlcost = $this->XMLFunctions->getAttributeValue($node, 'LVLCOST', 1);
		$lvlmultiplier = $this->XMLFunctions->getAttributeValue($node, 'LVLMULTIPLIER');
		$lvlpower = $this->XMLFunctions->getAttributeValue($node, 'LVLPOWER');
		$lvlval = $this->XMLFunctions->getAttributeValue($node, 'LVLVAL', 1);

		$returncost = 0;
		if ($basecost) {
			$returncost += $basecost;
		}
		if ($levels) {
			if ($lvlmultiplier && $lvlpower) {
				$returncost += pow($levels / ($lvlmultiplier * $lvlpower), 1 / $lvlpower) * $lvlcost;
			} else {
				$returncost += $levels * $lvlcost / $lvlval;
			}
		}
		return $returncost;
	}

//	public $components = [];
//	public $basequery = 'HEROCSHEET';
//	public $character_xml;
//	public $merged_xml;
//	public $cpath;
//	public $tpath;
//	public $idattribute = 'XMLID';
//	public $NodeStack;
//	public $XMLFunctions;
//
//	public function initialize(array $config) {
//		parent::initialize($config);
//		$this->NodeStack = new NodeStack();
//		$this->XMLFunctions = new XMLFunctions();
//		$this->character_xml = new \DOMDocument();
//		$this->character_xml->preserveWhiteSpace = false;
//		$this->character_xml->loadXML($config['character_xml']->saveXML());
//		$this->cpath = new \DOMXPath($this->character_xml);
//		$this->merged_xml = new \DOMDocument();
//		$this->merged_xml->preserveWhiteSpace = false;
//		$this->merged_xml->loadXML($config['merged_xml']->saveXML());
//		$this->tpath = new \DOMXPath($this->merged_xml);
//		if (isset($config['allowtext']) && $config['allowtext']) {
//			$this->skipempty = '';
//			$this->skipemptynodes = '/node()';
//		}
//		if (isset($config['basequery']) && $config['basequery']) {
//			$this->basequery = $config['basequery'];
//		}
//		if (isset($config['idattribute']) && $config['idattribute']) {
//			$this->idattribute = $config['idattribute'];
//		}
////		$xquery = "/HEROCSHEET/SKILLS/SKILL[@XMLID = 'GAMBLING']/ADDER[@XMLID = 'SPORTSBETTING' and @XMLID = 'FANDOM']/ADDER[@XMLID = 'STEELBALL']";
////		$xquery = 'HEROCSHEET';
////		debug($xquery);
////		$nodestack = $this->NodeStack->parseNodeString($xquery);
////		debug($nodestack);
////		$xquery = $this->NodeStack->buildNodeString($nodestack);
////		debug($xquery);
////		die(' ');
//	}
//	function firstPass($query = null, $depth = 0) {
//		if (!$query) {
//			$query = $this->character_xml->documentElement->getNodePath();
//		}
//		$nodelist = $this->XMLFunctions->getNodeList($this->character_xml, $query . $this->XMLFunctions->buildSkipEmpty());
//		if ($nodelist->length == 1) {
//			$node = $nodelist->item(0);
//		} else {
//			die('Multiple nodes found: ' . $query . ' returned -> ' . $nodelist->length . ' nodes');
//		}
//		// Set TAG and COST attributes in current node
//		$node->setAttribute('TAG', $node->nodeName);
//		$node->setAttribute('COST', $this->getCost($node));
//		if ($node->hasChildNodes()) {
//			foreach ($node->childNodes as $child) {
//				if ($child->nodeType != XML_TEXT_NODE) {
//					$this->firstPass($child->getNodePath(), $depth + 1);
//				}
//			}
//		}
//	}



//	function showErrorStack() {
//		foreach ($this->errorstack as $error) {
//			debug($error);
//		}
//		$this->errorstack = [];
//	}

}
