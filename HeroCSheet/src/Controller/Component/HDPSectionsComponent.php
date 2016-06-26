<?php

namespace MFC\HDParser\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HDPSectionsComponent
 * @author Michael
 */
class HDPSectionsComponent extends Component {

	public $components = ['Vorien/HDParser.HDPCore','Vorien/HDParser.HDPArray','Vorien/HDParser.HDPAdderModifier'];

	function getRawData($section, $type = null, $returnarray = array()) {
		foreach ($section as $key => $value) {
			if ($attributes = $this->HDPCore->hasAttributes($value)) {
//				debug($value);
				$outarray = $this->HDPArray->getEmptySectionArray($type);
				$outarray['adders'] = $this->HDPArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->HDPArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $this->HDPCore->getAttributeValue($attributes, 'DISPLAY');
							$outarray['alias'] = $this->HDPCore->getAttributeValue($attributes, 'ALIAS');
							$outarray['cost'] = $this->HDPCore->getCost($subvalue);
//							$outarray['basecost'] = $this->HDPCore->getCost($subvalue);
							$outarray['levels'] = $this->HDPCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->HDPCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->HDPCore->getAttributeValue($attributes, 'OPTION');
							$outarray['optionid'] = $this->HDPCore->getAttributeValue($attributes, 'OPTIONID');
							$outarray['optionalias'] = $this->HDPCore->getAttributeValue($attributes, 'OPTION_ALIAS');
							$outarray['inputlabel'] = $this->HDPCore->getAttributeValue($attributes, 'INPUTLABEL');
							$outarray['input'] = $this->HDPCore->getAttributeValue($attributes, 'INPUT');
							$outarray['name'] = $this->HDPCore->getAttributeValue($attributes, 'NAME');
							if($this->HDPCore->getAttributeValue($attributes, 'XMLID') == 'CONTACT' && $levels = $this->HDPCore->getAttributeValue($attributes, 'LEVELS')){
								$outarray['roll'] = $this->HDPCore->getRollFromLevels($levels);
							}
							if ($this->HDPArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->HDPCore->getRawExtras($subvalue, $outarray['type']));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->HDPAdderModifier->getAdders($subvalue, $type);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->HDPAdderModifier->getModifiers($subvalue, $type);
							break;
						case 'TYPE':
							$outarray['types'] = $subvalue;
							break;
						default:
							debug($subkey . " not found");
							debug($subvalue);
							break;
					}
				}
				$costarray = array('cost' => $outarray['adders']['cost'] + $outarray['cost'], 'advantages' => $outarray['modifiers']['advantages'], 'limitations' => $outarray['modifiers']['limitations']);
				$outarray['basecost'] = $costarray['cost'];
				$outarray['advantages'] = $costarray['advantages'];
				$outarray['limitations'] = $costarray['limitations'];
				$modifiedcostarray = $this->HDPCore->getModifiedCost($costarray);
				$outarray['cost'] = $modifiedcostarray['cost'];
				$outarray['extras'] = array_merge_recursive($outarray['extras'], $outarray['adders']['extras'], $outarray['modifiers']['extras']);
				$returnarray[$key] = $outarray;
			} else {
				$returnarray = $this->getRawData($value, $type, $returnarray);
			}
		}
		return $returnarray;
	}

	function getSpellCards($powers, $returnarray = array()) {
		foreach ($powers as $key => $value) {
			if ($attributes = $this->HDPCore->hasAttributes($value)) {
				$outarray = $this->HDPArray->getEmptySectionArray();
				$outarray['adders'] = $this->HDPArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->HDPArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->HDPCore->getCost($subvalue);
//							$outarray['basecost'] = $this->HDPCore->getCost($subvalue);
							$outarray['levels'] = $this->HDPCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->HDPCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->HDPCore->getAttributeValue($attributes, 'OPTION');
							if ($this->HDPArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->HDPCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->HDPAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->HDPAdderModifier->getModifiers($subvalue);
							break;
						case 'TYPE':
							$outarray['types'] = $subvalue;
							break;
						default:
							debug($subkey . " not found");
							break;
					}
				}
				$costarray = array('cost' => $outarray['adders']['cost'] + $outarray['cost'], 'advantages' => $outarray['modifiers']['advantages'], 'limitations' => $outarray['modifiers']['limitations']);
				$outarray['basecost'] = $costarray['cost'];
				$outarray['advantages'] = $costarray['advantages'];
				$outarray['limitations'] = $costarray['limitations'];
				$modifiedcostarray = $this->HDPCore->getModifiedCost($costarray);
				$outarray['cost'] = $modifiedcostarray['cost'];
				$outarray['extras'] = array_merge_recursive($outarray['extras'], $outarray['adders']['extras'], $outarray['modifiers']['extras']);
				$returnarray[$key] = $outarray;
			} else {
				$returnarray = $this->getSpellCards($value, $returnarray);
			}
		}
		return $returnarray;
	}

	function getPowers($powers, $returnarray = array()) {
		foreach ($powers as $key => $value) {
			if ($attributes = $this->HDPCore->hasAttributes($value)) {
				$outarray = $this->HDPArray->getEmptySectionArray('power');
				$outarray['adders'] = $this->HDPArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->HDPArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->HDPCore->getCost($subvalue);
//							$outarray['basecost'] = $this->HDPCore->getCost($subvalue);
							$outarray['levels'] = $this->HDPCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->HDPCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->HDPCore->getAttributeValue($attributes, 'OPTION');
							if ($this->HDPArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->HDPCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->HDPAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->HDPAdderModifier->getModifiers($subvalue);
							break;
						case 'TYPE':
							$outarray['types'] = $subvalue;
							break;
						default:
							debug($subkey . " not found");
							break;
					}
				}
				$costarray = array('cost' => $outarray['adders']['cost'] + $outarray['cost'], 'advantages' => $outarray['modifiers']['advantages'], 'limitations' => $outarray['modifiers']['limitations']);
				$outarray['basecost'] = $costarray['cost'];
				$outarray['advantages'] = $costarray['advantages'];
				$outarray['limitations'] = $costarray['limitations'];
				$modifiedcostarray = $this->HDPCore->getModifiedCost($costarray);
				$outarray['cost'] = $modifiedcostarray['cost'];
				$outarray['extras'] = array_merge_recursive($outarray['extras'], $outarray['adders']['extras'], $outarray['modifiers']['extras']);
				$returnarray[$key] = $outarray;
			} else {
				$returnarray = $this->getPowers($value, $returnarray);
			}
		}
		return $returnarray;
	}

	function getPerks($perks, $returnarray = array()) {
		foreach ($perks as $key => $value) {
			if ($attributes = $this->HDPCore->hasAttributes($value)) {
				$outarray = $this->HDPArray->getEmptySectionArray();
				$outarray['adders'] = $this->HDPArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->HDPArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->HDPCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->HDPCore->getCost($subvalue);
//							$outarray['basecost'] = $this->HDPCore->getCost($subvalue);
							$outarray['levels'] = $this->HDPCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->HDPCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->HDPCore->getAttributeValue($attributes, 'OPTION');
							if($this->HDPCore->getAttributeValue($attributes, 'XMLID') == 'CONTACT' && $levels = $this->HDPCore->getAttributeValue($attributes, 'LEVELS')){
								$outarray['roll'] = $this->HDPCore->getRollFromLevels($levels);
							}
							if ($this->HDPArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->HDPCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->HDPAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->HDPAdderModifier->getModifiers($subvalue);
							break;
						case 'TYPE':
							$outarray['types'] = $subvalue;
							break;
						default:
							debug($subkey . " not found");
							debug($subvalue);
							break;
					}
				}
				$costarray = array('cost' => $outarray['adders']['cost'] + $outarray['cost'], 'advantages' => $outarray['modifiers']['advantages'], 'limitations' => $outarray['modifiers']['limitations']);
				$outarray['basecost'] = $costarray['cost'];
				$outarray['advantages'] = $costarray['advantages'];
				$outarray['limitations'] = $costarray['limitations'];
				$modifiedcostarray = $this->HDPCore->getModifiedCost($costarray);
				$outarray['cost'] = $modifiedcostarray['cost'];
				$outarray['extras'] = array_merge_recursive($outarray['extras'], $outarray['adders']['extras'], $outarray['modifiers']['extras']);
				$returnarray[$key] = $outarray;
			} else {
				$returnarray = $this->getPerks($value, $returnarray);
			}
		}
		return $returnarray;
	}


	function getTalents($talent) {
		$array = $this->HDPCore->getFirstWithAttributes($talent);
		$attributes = $array['attributes'];
		$extras = array();
		$affects = array();
		if ($this->HDPArray->getArrayKeyCount($array) > 1) {
			if (array_key_exists('ADDER', $array)) {
				foreach ($array['ADDER'] as $key => $value) {
					if ($subattributes = $this->HDPCore->hasAttributes($value)) {
						if ($alias = $this->HDPCore->getAttributeValue($subattributes, 'ALIAS')) {
							$affects[$alias] = $alias;
						}
					}
				}
				if ($key != 'attributes') {
					$affects[] = $key;
				}
			}
		}
		if (!empty($affects)) {
			$extras[] = "Applies to: " . implode(", ", $affects);
		}
		if (strpos($attributes['ALIAS'], ')') !== false) {
			$displaycontent = preg_split("/[()]/", $attributes['ALIAS']);
			$display = trim($displaycontent[0]);
			if (count($displaycontent) >= 2) {
				$extras[] = trim($displaycontent[1]);
			}
		} else {
			$displaycontent = explode(":", $attributes['ALIAS']);
			if (count($displaycontent) == 2) {
				$display = trim($displaycontent[1]);
				$extras[] = trim($displaycontent[0]);
			} else {
				$display = trim($displaycontent[0]);
			}
		}
		$cost = $this->HDPCore->getTalentCost($talent);
		
		if (array_key_exists('OPTION_ALIAS', $attributes)) {
			$extras[] = $attributes['OPTION_ALIAS'];
		}
		return array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'talent', 'extras' => $extras, 'affects' => $affects);
	}

}
