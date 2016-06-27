<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP PSectionsComponent
 * @author Michael
 */
class PSectionsComponent extends Component {

	public $components = ['Vorien/HeroCSheet.PCore','Vorien/HeroCSheet.PArray','Vorien/HeroCSheet.PAdderModifier'];

	function getRawData($section, $type = null, $returnarray = array()) {
		foreach ($section as $key => $value) {
			if ($attributes = $this->PCore->hasAttributes($value)) {
//				debug($value);
				$outarray = $this->PArray->getEmptySectionArray($type);
				$outarray['adders'] = $this->PArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->PArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->PCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->PCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $this->PCore->getAttributeValue($attributes, 'DISPLAY');
							$outarray['alias'] = $this->PCore->getAttributeValue($attributes, 'ALIAS');
							$outarray['cost'] = $this->PCore->getCost($subvalue);
//							$outarray['basecost'] = $this->PCore->getCost($subvalue);
							$outarray['levels'] = $this->PCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->PCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->PCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->PCore->getAttributeValue($attributes, 'OPTION');
							$outarray['optionid'] = $this->PCore->getAttributeValue($attributes, 'OPTIONID');
							$outarray['optionalias'] = $this->PCore->getAttributeValue($attributes, 'OPTION_ALIAS');
							$outarray['inputlabel'] = $this->PCore->getAttributeValue($attributes, 'INPUTLABEL');
							$outarray['input'] = $this->PCore->getAttributeValue($attributes, 'INPUT');
							$outarray['name'] = $this->PCore->getAttributeValue($attributes, 'NAME');
							if($this->PCore->getAttributeValue($attributes, 'XMLID') == 'CONTACT' && $levels = $this->PCore->getAttributeValue($attributes, 'LEVELS')){
								$outarray['roll'] = $this->PCore->getRollFromLevels($levels);
							}
							if ($this->PArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->PCore->getRawExtras($subvalue, $outarray['type']));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->PAdderModifier->getAdders($subvalue, $type);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->PAdderModifier->getModifiers($subvalue, $type);
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
				$modifiedcostarray = $this->PCore->getModifiedCost($costarray);
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
			if ($attributes = $this->PCore->hasAttributes($value)) {
				$outarray = $this->PArray->getEmptySectionArray();
				$outarray['adders'] = $this->PArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->PArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->PCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->PCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->PCore->getCost($subvalue);
//							$outarray['basecost'] = $this->PCore->getCost($subvalue);
							$outarray['levels'] = $this->PCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->PCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->PCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->PCore->getAttributeValue($attributes, 'OPTION');
							if ($this->PArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->PCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->PAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->PAdderModifier->getModifiers($subvalue);
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
				$modifiedcostarray = $this->PCore->getModifiedCost($costarray);
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
			if ($attributes = $this->PCore->hasAttributes($value)) {
				$outarray = $this->PArray->getEmptySectionArray('power');
				$outarray['adders'] = $this->PArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->PArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->PCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->PCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->PCore->getCost($subvalue);
//							$outarray['basecost'] = $this->PCore->getCost($subvalue);
							$outarray['levels'] = $this->PCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->PCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->PCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->PCore->getAttributeValue($attributes, 'OPTION');
							if ($this->PArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->PCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->PAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->PAdderModifier->getModifiers($subvalue);
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
				$modifiedcostarray = $this->PCore->getModifiedCost($costarray);
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
			if ($attributes = $this->PCore->hasAttributes($value)) {
				$outarray = $this->PArray->getEmptySectionArray();
				$outarray['adders'] = $this->PArray->getEmptyAaMArray();
				$outarray['modifiers'] = $this->PArray->getEmptyAaMArray();
				foreach ($value as $subkey => $subvalue) {
					switch ($subkey) {
						case 'attributes':
							if (!($display = $this->PCore->getAttributeValue($subvalue, 'NAME'))) {
								if (!($display = $this->PCore->getAttributeValue($subvalue, 'ALIAS'))) {
									$display = $key;
								}
							}
							$outarray['display'] = $display;
							$outarray['cost'] = $this->PCore->getCost($subvalue);
//							$outarray['basecost'] = $this->PCore->getCost($subvalue);
							$outarray['levels'] = $this->PCore->getAttributeValue($attributes, 'LEVELS');
							$outarray['lvlcost'] = $this->PCore->getAttributeValue($attributes, 'LVLCOST');
							$outarray['xmlid'] = $this->PCore->getAttributeValue($attributes, 'XMLID');
							$outarray['option'] = $this->PCore->getAttributeValue($attributes, 'OPTION');
							if($this->PCore->getAttributeValue($attributes, 'XMLID') == 'CONTACT' && $levels = $this->PCore->getAttributeValue($attributes, 'LEVELS')){
								$outarray['roll'] = $this->PCore->getRollFromLevels($levels);
							}
							if ($this->PArray->multi_array_key_search("REQUIRESASKILLROLL", $value, true)) {
								$outarray['skillroll'] = 'required';
							}
							$outarray['extras'] = array_merge_recursive($outarray['extras'], $this->PCore->getExtras($subvalue));
							break;
						case 'NOTES':
							$outarray['extras'][] = $subvalue;
							break;
						case 'ADDER':
							$outarray['adders'] = $this->PAdderModifier->getAdders($subvalue);
							break;
						case 'MODIFIER':
							$outarray['modifiers'] = $this->PAdderModifier->getModifiers($subvalue);
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
				$modifiedcostarray = $this->PCore->getModifiedCost($costarray);
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
		$array = $this->PCore->getFirstWithAttributes($talent);
		$attributes = $array['attributes'];
		$extras = array();
		$affects = array();
		if ($this->PArray->getArrayKeyCount($array) > 1) {
			if (array_key_exists('ADDER', $array)) {
				foreach ($array['ADDER'] as $key => $value) {
					if ($subattributes = $this->PCore->hasAttributes($value)) {
						if ($alias = $this->PCore->getAttributeValue($subattributes, 'ALIAS')) {
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
		$cost = $this->PCore->getTalentCost($talent);
		
		if (array_key_exists('OPTION_ALIAS', $attributes)) {
			$extras[] = $attributes['OPTION_ALIAS'];
		}
		return array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'talent', 'extras' => $extras, 'affects' => $affects);
	}

}
