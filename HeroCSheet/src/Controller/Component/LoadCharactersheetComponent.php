<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Core\App;

require_once(App::path('Lib', 'Vorien/HeroCSheet')[0] . 'XMLFunctions.php');

use XMLFunctions;

/**
 * LoadCharactersheetComponent component
 */
class LoadCharactersheetComponent extends Component {

	public $XMLFunctions;
	public $errorstack = [];
	public $character_xml;
	public $processed = ['BASIC_CONFIGURATION' => [], 'CHARACTER_INFO' => [], 'CHARACTERISTICS' => [], 'SKILLS' => [], 'PERKS' => [], 'TALENTS' => [], 'MARTIALARTS' => [], 'POWERS' => [], 'DISADVANTAGES' => [], 'EQUIPMENT' => [], 'SKILL_ENHANCERS' => []];
	public $rolluparray = ['cost' => 0, 'add' => 0, 'plus' => 0, 'minus' => 0, 'definition' => [], 'notes' => []];
	private $CharactersheetsTable;
	private $idattribute = 'XMLID';
	private $charactersheet_id;
	private $basequery = 'HEROCSHEET';
	private $skilllevels;
	private $skillenhancers;
	private $selectedattributes = [];
	private $characteristicrolls = [];

	public function setConfiguration(array $config) {
		$this->CharactersheetsTable = TableRegistry::get('Vorien/HeroCSheet.Charactersheets');
		if (isset($config['basequery']) && $config['basequery']) {
			$this->basequery = $config['basequery'];
		}
		$this->character_xml = new \DOMDocument();
		$this->character_xml->preserveWhiteSpace = false;
		$this->character_xml->formatOutput = true;
		$this->character_xml->loadXML($config['character_xml']->saveXML());
		$this->charactersheet_id = $config['charactersheet_id'];
		if (isset($config['idattribute']) && $config['idattribute']) {
			$this->idattribute = $config['idattribute'];
		}
		$this->XMLFunctions = new XMLFunctions(['idattribute' => $this->idattribute]);
		$this->skilllevels = $this->getSkillLevels();
		$this->skillenhancers = $this->getSkillEnhancers();
	}

	function loadCharactersheet() {
//		$cpath = new \DOMXPath($this->character_xml);
////		$nodelist = $cpath->query($this->XMLFunctions->buildNodeQuery('//*[@DISPLAYINSTRING="Yes"]'));
//		$nodelist = $cpath->query($this->XMLFunctions->buildNodeQuery('//*[@TEXT]'));
//		foreach ($nodelist as $node) {
////		if($this->XMLFunctions->getAttributeValue($node,'ALIAS') != $this->XMLFunctions->getAttributeValue($node,'DISPLAY') || $this->XMLFunctions->getAttributeValue($node,'TEXT',false)){
//			$this->XMLFunctions->displayNode($node);			
////		}
////			echo $this->XMLFunctions->getAttributeValue($node,$this->idattribute), ',', 
////					$this->XMLFunctions->getAttributeValue($node,'CHARACTERISTIC'), ',', 
////					$this->XMLFunctions->getAttributeValue($node,'ALIAS'), ',', 
////					$this->XMLFunctions->getAttributeValue($node,'BASECOST'), '<br>';
//		}
//		die();

		$charactersheet = $this->CharactersheetsTable->get($this->charactersheet_id);
		if ($charactersheet) {
			if ($this->skilllevels === null) {
				// applySkillLevels failed with an error
			}
			$this->processCharactersheetForDBLoad();
//			debug($this->character_xml->saveXML());
//			debug($this->processed);
			$this->finalizeProcessedArray();
			$character_sxml = simplexml_load_string($this->character_xml->saveXML());

			foreach ($character_sxml->children() as $child) {
				$child_name = strtolower($child->getName());
				$child_xml = $child->asXML();
				$charactersheet->$child_name = $child_xml;
			}
			$this->CharactersheetsTable->save($charactersheet);
		} else {
			debug('Charactersheet id: ' . $this->charactersheet_id . ' not found');
		}
	}

	function getSkillRoll(&$skill) {
		if ($roll = $this->isFamiliarityOrProficiency($skill['attributes'])) {
//			debug('F or P roll: ' . $roll);
			return $roll;
		}
		if ($characteristic = $this->getArrayValue('CHARACTERISTIC', $skill['attributes'])) {
			if (!($base = $this->getArrayValue($characteristic, $this->characteristicrolls))) {
				$base = 11;
				if ($costsavings = $this->getArrayValue('costsavings', $skill)) {
					$skill['cost'] -= $costsavings;
				}
			}
//			debug('base roll: ' . $base);
			$levels = $this->getArrayValue('LEVELS', $skill['attributes'], 0);
			$skilllevels = $this->getArrayValue('skilllevels', $skill, 0);
			$roll = $base + $levels + $skilllevels;
			if (($maxima = $this->getArrayValue('SKILLMAXIMALIMIT', $skill['attributes'])) && $roll > $maxima) {
				$roll = $maxima + floor(($roll - $maxima) / 2);
			}
			return $roll;
		} else {
			// Error: no matching characteristicroll or base not set
			return null;
		}
	}

	function isFamiliarityOrProficiency($array) {
		if (($familiarity = $this->getArrayValue('FAMILIARITY', $array)) && $familiarity == 'Yes') {
			return 8;
		}
		if (($proficiency = $this->getArrayValue('PROFICIENCY', $array)) && $proficiency == 'Yes') {
			return 10;
		}
		return false;
	}

	function finalizeProcessedArray() {
		foreach ($this->processed as $key => &$value) {
			if ($value && is_array($value)) {
				switch ($key) {
					case 'BASIC_CONFIGURATION':
						break;
					case 'CHARACTER_INFO':
						break;
					case 'CHARACTERISTICS':
						foreach ($value as $characteristic) {
							if ($roll = $this->getArrayValue('roll', $characteristic)) {
								$this->characteristicrolls[$characteristic['display']] = $roll;
							}
						}
//						debug($value);
						break;
					case 'SKILLS':
						foreach ($value as &$skill) {
							if (!$this->getArrayValue('skilltype', $skill)) {
								debug('skilltype not set');
								debug($skill);
							} else {
								switch ($skill['skilltype']) {
									case 'rolled':
										$skill['roll'] = $this->getSkillRoll($skill);
//										if($skill['attributes'][$this->idattribute] == 'PERCEPTION'){
//											debug($skill);
//										}
										break;
									case 'background':
										$skill['roll'] = $this->getSkillRoll($skill);
										break;
									case 'levels':
										$skill['levels'] = $this->getArrayValue('LEVELS', $skill['attributes'], 0);
										break;
									case 'familiarity':
//										debug($skill);
										break;
									default:
										debug('Unknown skilltype: ' . $skill['skilltype']);
										debug($skill);
										break;
								}
							}
						}
						break;
					case 'PERKS':
//						foreach ($value as $characteristic) {
//							debug($characteristic);
//						}
						break;
					case 'TALENTS':
						break;
					case 'MARTIALARTS':
						break;
					case 'POWERS':
						break;
					case 'DISADVANTAGES':
						break;
					case 'EQUIPMENT':
						break;
					case 'SKILL_ENHANCERS':
						break;
				}
			}
		}
		$this->cleanProcessedArray();
		debug($this->processed);
	}

	function cleanProcessedArray(){
		$skillsarray = [];
		foreach ($this->processed as $key => &$value) {
			if ($value && is_array($value)) {
				foreach($value as &$item){
					$notes = $this->consolidateArray($this->getArrayValue('notes', $item, []));
					$item['notes'] = $notes;
					$definition = $this->consolidateArray($this->getArrayValue('definition', $item, []));
					$item['definition'] = $definition;
					if(array_key_exists('attributes', $item)){
						unset($item['attributes']);
					}
					if($key == 'SKILLS'){
						if(!array_key_exists($item['skilltype'], $skillsarray)){
							$skillsarray[$item['skilltype']] = [];
						}
						$skillsarray[$item['skilltype']][] = $item;
					}
				}
			}
		}
		$this->processed['SKILLS'] = $skillsarray;
	}
	
	function consolidateArray($array = []){
		$return = [];
		if(is_array($array)){
			foreach($array as $key => $value){
				if(is_array($value)){
					$return = array_merge($return, $this->consolidateArray($value));
				} else {
					if($value){
						$return[] = $value;
					}
				}
			}
		}
		return $return;
	}
	
	function processCharactersheetForDBLoad($query = null, $depth = 0) {
		$rollup = $this->rolluparray;
		if (!$query) {
			$query = $this->basequery;
//			$query = '/HEROCSHEET/POWERS/POWER[@XMLID = "DARKNESS"]';
		}
		$nodelist = $this->XMLFunctions->getNodeList($this->character_xml, $query . $this->XMLFunctions->buildSkipEmpty());
		if ($nodelist->length == 1) {
			$node = $nodelist->item(0);
		} else {
			die('Multiple nodes found: ' . $query . ' returned -> ' . $nodelist->length . ' nodes');
		}
//		debug($node->getNodePath() . ' / ' . $node->getAttribute($this->idattribute));
		$rollup['cost'] = $this->getCost($node);
		if ($definition = $this->XMLFunctions->getAttributeValue($node, 'DEFINITION')) {
			$rollup['definition'][] = addslashes($definition);
		}

		if (($displayinstring = $this->XMLFunctions->getAttributeValue($node, 'DISPLAYINSTRING')) && $displayinstring == 'Yes') {
			if ($note = $this->getDisplay($this->XMLFunctions->getAttributesAsArray($node))) {
				$rollup['notes'][$depth][] = addslashes($note);
//				debug($rollup['notes']);
			}
		}

//		if ($notes = $this->getNotes($node)) {
//			$rollup['notes'][] = $notes;
//		}

		if ($node->hasChildNodes()) {
			foreach ($node->childNodes as $child) {
				if ($child->nodeName == 'NOTES' && $child->nodeValue) {
					$rollup['notes'][] = addslashes(preg_replace('/[\t|\r|\n]/', '', $child->nodeValue));
//					debug($rollup['notes']);
					continue;
				}
				if ($child->nodeType == XML_TEXT_NODE || $child->nodeName == 'text()') {
					continue;
				}
//						debug($child->getNodePath() . ' / ' . $node->getAttribute($this->idattribute));
				$childrollup = $this->processCharactersheetForDBLoad($child->getNodePath(), $depth + 1);
//						debug($childrollup);
				$this->combineRollupArrays($rollup, $childrollup);
//						debug($rollup);
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
				if ($node->hasAttribute($this->idattribute)) {
					$nodedata = [];
//					debug($rollup['notes']);
//					debug($node->getNodePath() . ' -> ' . $node->getAttribute($this->idattribute));
					$this->selectedattributes = $this->getSelectedAttributes($node);
					$nodedata['attributes'] = $this->selectedattributes;
//					if($this->selectedattributes[$this->idattribute] == 'END'){
//						debug($this->selectedattributes);
//					}
					$nodedata['cost'] = $rollup['cost'];
					if ($display = $this->getDisplay()) {
						$nodedata['display'] = $display;
					} else {
						// Arriving here means that none of the display construction options worked
						debug('Display value not found for ' . $node->getNodePath());
					}
					$nodedata['notes'] = $this->array_remove_empty($rollup['notes']);
					$rollup['notes'] = [];
					$nodedata['definition'] = $this->array_remove_empty($rollup['definition']);
					$rollup['definition'] = [];

					if ($node->parentNode->nodeName == 'CHARACTERISTICS') {
						$nodedata['value'] = $this->selectedattributes['STATCALC'] = $this->getCharacteristicValue();
						if (in_array($this->selectedattributes[$this->idattribute], ['STR', 'DEX', 'CON', 'INT', 'EGO', 'PRE'])) {
							if ($characteristicroll = $this->getCharacteristicRoll()) {
								$nodedata['roll'] = $characteristicroll;
							}
							if ($characteristicdice = $this->getCharacteristicDice()) {
								$nodedata['dice'] = $characteristicdice;
							}
						}
					} else {
						switch ($node->nodeName) {
							case 'SKILL':
								switch ($this->selectedattributes[$this->idattribute]) {
									case "SKILL_LEVELS":
									case "COMBAT_LEVELS":
									case "PENALTY_SKILL_LEVELS":
									case "LANGUAGES":
										$nodedata['skilltype'] = 'levels';
										// No rolls or values, just levels/definition/notes;
										break;
									case "TRANSPORT_FAMILIARITY":
									case "WEAPON_FAMILIARITY":
										$nodedata['skilltype'] = 'familiarity';
										// No rolls or values, just definition/notes;
										break;
									default:
										if ($characteristic = $this->XMLFunctions->getAttributeValue($node, 'CHARACTERISTIC')) {
											if ($characteristic != 'GENERAL') {
												$nodedata['skilltype'] = 'rolled';
												if ($skilllevels = $this->applySkillLevels()) {
													$nodedata['skilllevels'] = $skilllevels;
												}
											} else {
												if (in_array($this->selectedattributes['ALIAS'], ['PS', 'LANGUAGE', 'SS', 'KS', 'AK', 'CuK', 'CONTACT'])) {
													if ($costsavings = $this->applySkillEnhancers()) {
														$nodedata['costsavings'] = $costsavings;
													}
													$nodedata['skilltype'] = 'background';
												} else {
													$this->XMLFunctions->displayNode($node);
												}
											}
										}
										break;
								}
								break;
							case 'PERK':
								break;
							case 'TALENT':
								break;
							case 'DISAD':
								break;
							case 'ENHANCER':
								$nodedata['skilltype'] = 'enhancer';
								$this->selectedattributes['TAG'] = 'SKILL';
								break;
							case 'POWER':
								break;
							default:
								debug($node->nodeName);
								break;
						}
					}
					$this->processed[$node->parentNode->nodeName][] = $nodedata;
				} else {
					//Non ADDER/MODIFIER nodes without ids aren't used in the rollups
				}
				break;
		}
		return $rollup;
	}

	function getCharacteristicValue() {
		$stat = 0;
		$stat = $this->selectedattributes['BASE'] + $this->selectedattributes['LEVELS'];
		if ($maxima = $this->getArrayValue('CHARACTERISTICMAXIMA', $this->selectedattributes)) {
			if ($stat > $maxima) {
				$stat = $maxima + floor(($stat - $maxima) / 2);
			}
		}
		return $stat;
	}

	function getCharacteristicRoll() {
		$roll = $this->selectedattributes['CHARROLLBASE'] + round($this->selectedattributes['STATCALC'] / $this->selectedattributes['CHARROLLDENOMINATOR'], 0);
		return $roll;
	}

	function getCharacteristicDice() {
		$dice = $this->roundToNearestHalf($this->selectedattributes['STATCALC'] / 5);
		return $dice;
	}

	function roundToNearestHalf($value) {
		return round(floor(($value * 2)) / 2, 1);
	}

	function getSkillLevels() {
		$nodelist = $this->XMLFunctions->getNodeList($this->character_xml, '/HEROCSHEET/SKILLS/SKILL[@XMLID = "SKILL_LEVELS"]' . $this->XMLFunctions->buildSkipEmpty());
		if (!$nodelist->length) {
			// Character has no skill levels
			return false;
		} else {
			$skilllevels = [];
			foreach ($nodelist as $node) {
				if (($option = $this->XMLFunctions->getAttributeValue($node, 'OPTION')) && ($levels = $this->XMLFunctions->getAttributeValue($node, 'LEVELS'))) {
					$skilllevels[$option] = $levels;
				} else {
					//Error has occurred, XMLID is SKILL_LEVELS, but OPTION or LEVELS not set.
					return null;
				}
			}
		}
//		debug($skilllevels);
		return $skilllevels;
	}

	function getSkillEnhancers() {
		$nodelist = $this->XMLFunctions->getNodeList($this->character_xml, '/HEROCSHEET/SKILL_ENHANCER/ENHANCER' . $this->XMLFunctions->buildSkipEmpty());
		if (!$nodelist->length) {
			// Character has no skill enhancers
			return [];
		} else {
			$skillenhancers = [];
			foreach ($nodelist as $node) {
				if ($levels = $this->XMLFunctions->getAttributeValue($node, 'COSTSAVINGS')) {
					switch ($node->XMLFunctions->getAttributeValue($node, $this->idattribute)) {
						case 'JACK_OF_ALL_TRADES':
							$skillenhancers['PS'] = $levels;
							break;
						case 'LINGUIST':
							$skillenhancers['LANGUAGE'] = $levels;
							break;
						case 'SCIENTIST':
							$skillenhancers['SS'] = $levels;
							break;
						case 'SCHOLAR':
							$skillenhancers['KS'] = $levels;
							break;
						case 'TRAVELER':
							$skillenhancers['AK'] = $levels;
							$skillenhancers['CuK'] = $levels;
							break;
						case 'WELL_CONNECTED':
							$skillenhancers['CONTACT'] = $levels;
							break;
						default:
							break;
					}
				} else {
					// Not an error, the enhancer could be a placeholder for grouping.
				}
			}
		}
		return $skillenhancers;
	}

	function applySkillLevels() {
		$skilllevel = false;
		switch ($this->selectedattributes['CHARACTERISTIC']) {
			case 'DEX':
				$levelname = 'AGILITY';
				break;
			case 'PRE':
				$levelname = 'INTERACTION';
				break;
			case 'EGO':
				$levelname = 'WILLPOWER';
				break;
			case 'INT':
				if ($this->selectedattributes[$this->idattribute] == 'PERCEPTION') {
					$levelname = 'PERCEPTION';
				} else {
					$levelname = 'INTELLECT';
				}
				break;
			default:
				$levelname = 'NOT USED';
				break;
		}
//		debug($levelname);
//		debug($this->skilllevels);
		if ($name = $this->getArrayValue($levelname, $this->skilllevels)) {
//			debug($this->skilllevels[$levelname]);
			$skilllevel = $name;
		}
//		debug($skilllevel);
		return $skilllevel;
	}

	function applySkillEnhancers() {
		if ($alias = $this->getArrayValue($this->selectedattributes['ALIAS'], $this->skillenhancers)) {
			return $alias;
		} else {
			return false;
		}
	}

	function getDisplay($attributes = []) {
		$return = false;
		if (!$attributes) {
			$attributes = $this->selectedattributes;
		}
//		debug($attributes);
		if (($talent = $this->getArrayValue('TAG', $attributes)) && $talent == 'TALENT') {
			$addon = '';
			$return = $attributes['ALIAS'];
			if(($levels = $this->getArrayValue('LEVELS', $attributes)) && $levels != 0) {
				$addon = '+' . $levels . ' ';
			}
			if(($optionalias = $this->getArrayValue('OPTION_ALIAS', $attributes))) {
				$addon .= $optionalias;
			}
			if($addon){
				$return .= ' - ' . $addon;
			}
//			debug('talent: ' . $return);
		} else if (!empty($attributes['NAME']) && !empty($attributes['DISPLAY']) && $attributes['NAME'] != $attributes['DISPLAY']) {
			$return = $attributes['DISPLAY'] . ': ' . $attributes['NAME'];
//			debug('Step 1: ' . $return);
//			debug($attributes);
		} else if (!empty($attributes['NAME']) && !empty($attributes['ALIAS']) && $attributes['NAME'] != $attributes['ALIAS']) {
			$return = $attributes['ALIAS'] . ': ' . $attributes['NAME'];
//			debug('Step 2: ' . $return);
//			debug($attributes);
		} else if (!empty($attributes['INPUT']) && !empty($attributes['ALIAS'])) {
			$return = $attributes['ALIAS'] . ': ' . $attributes['INPUT'];
//			debug('Step 3: ' . $return);
		} else if (!empty($attributes['ALIAS']) && !empty($attributes['OPTION_ALIAS'])) {
			$return = $attributes['ALIAS'] . ': ' . $attributes['OPTION_ALIAS'];
//			debug('Step 4: ' . $return);
//		} else if (!empty($attributes['DISPLAY']) && !empty($attributes['ALIAS']) && $attributes['DISPLAY'] == $attributes['ALIAS']) {
//			$return = $attributes['ALIAS'];
////			debug('Step 4: ' . $return);
//			debug($attributes);
		} else if (!empty($attributes['DISPLAY']) && !empty($attributes['ALIAS']) && $attributes['DISPLAY'] != $attributes['ALIAS']) {
			$return = $attributes['DISPLAY'];
//			debug('Step 5: ' . $return);
//			debug($attributes);
		} else if (!empty($attributes['ALIAS']) && empty($attributes['OPTION_ALIAS']) && !empty($attributes['DISPLAY'])) {
			$return = $attributes['DISPLAY'];
//			debug('Step 6: ' . $return);
		} else if (!empty($attributes['ALIAS'])) {
			$return = $attributes['ALIAS'];
//			debug('Step 7: ' . $return);
//			debug($attributes);
		} else {
			$return = false;
//			debug('Step D: ' . $return);
		}
		return $return;
	}

	function getSelectedAttributes(&$node) {
		$attributes = [
			'TAG' => $node->nodeName,
			'PARENT' => $node->parentNode->nodeName
		];
		$attributelist = [
			$this->idattribute,
			'ALIAS',
			'DISPLAY',
			'NAME',
			'INPUT',
			'OPTION_ALIAS',
			'LEVELS',
			'LVLVAL',
			'LEVELVAL',
			'BASE',
			'BASECOST',
			'FAMILIARITY',
			'PROFICIENCY',
			'CHARACTERISTIC',
			'SKILLMAXIMA',
			'SKILLMAXIMALIMIT',
			'SKILLROLLBASE',
			'SKILLROLLDENOMINATOR',
			'CHARACTERISTICMAXIMA',
			'CHARROLLBASE',
			'CHARROLLDENOMINATOR'
		];
		foreach ($attributelist as $attribute) {
			$add = $this->XMLFunctions->getAttributeValue($node, $attribute);
			if ($add !== null) {
				$attributes[$attribute] = $add;
			}
		}
		return $attributes;
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
		if ($combinerollup['definition']) {
			$rollup['definition'][] = $combinerollup['definition'];
		}
		if ($combinerollup['notes']) {
			$rollup['notes'][] = $combinerollup['notes'];
		}
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

	function array_remove_empty($array) {
		$fn = __FUNCTION__;
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$array[$key] = $this->$fn($array[$key]);
			}
			if (empty($array[$key])) {
				unset($array[$key]);
			}
		}
		return $array;
	}

	function getArrayValue($name, $array, $default = null) {
		if (array_key_exists($name, $array)) {
			$value = $array[$name];
			if(is_array($value)){
				if(empty($value)){
					return $default;
				} else {
					return $value;
				}
			}
			if ($value === null || $value === false || strlen(trim($value)) == 0) {
				return $default;
			} else {
				return $value;
			}
		} else {
			return $default;
		}
	}

//	public $components = [];
//	public $basequery = 'HEROCSHEET';
//	public $character_xml;
//	public $merged_xml;
//	public $cpath;
//	public $tpath;
//	public $idattribute = $this->idattribute;
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
