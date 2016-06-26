<?php

namespace MFC\HDParser\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HDPSkillDisplayComponent
 * @author Michael
 */
class HDPSkillDisplayComponent extends Component {

	public $components = ['Vorien/HDParser.HDPCore'];

	function getSkillLevelDisplay($skilllevel) {
		$attributes = $skilllevel['attributes'];
		$xmlid = $attributes['XMLID'];
		$display = "SL: " . $attributes['OPTION'];
		$cost = $attributes['LEVELS'] * $attributes['LVLCOST'];
		$levels = $attributes['LEVELS'];
		$option = $attributes['OPTION'];
		$extras = array();
		$affects = array();
		if (array_key_exists('ADDER', $skilllevel)) {
			foreach ($skilllevel['ADDER'] as $subkey => $subvalue) {
				$affects[$subkey] = $subkey;
			}

			$extras[] = "+" . $attributes['LEVELS'] . " with " . implode(", ", array_map('ucfirst', array_map('strtolower', $affects)));
		} else {
			$extras[] = "+" . $attributes['LEVELS'] . " " . $attributes['OPTION_ALIAS'];
		}
		$returnarray = array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'level', 'levels' => $levels, 'option' => $option, 'extras' => $extras, 'affects' => $affects, 'id' => $xmlid);
		return($returnarray);
	}

	function getMultiLevelSkillDisplay($multilevel, $characteristics) {
		$initialattributes = $multilevel['attributes'];
		$xmlid = $initialattributes['XMLID'];
		$display = $initialattributes['DISPLAY'];
		$type = $this->HDPCore->getAttributeValue($initialattributes, 'TYPE', null);
		$familiarity = $initialattributes['FAMILIARITY'];
		$characteristic = $initialattributes['CHARACTERISTIC'];
		$levels = $initialattributes['LEVELS'];
		$lvlval = $initialattributes['LVLVAL'];
		$basecost = $initialattributes['BASECOST'];
		$extras = array();
		$cost = $initialattributes['LEVELS'] * $initialattributes['LVLCOST'];
		if (array_key_exists('ADDER', $multilevel)) {
			foreach ($multilevel['ADDER'] as $key => $value) {
				if ($key !== 'ADDER') {
					if ($key === 'attributes') {
						$attributes = $value;
						$fullvalue = $multilevel['ADDER'];
					} else {
						$attributes = $this->HDPCore->hasAttributes($value);
						$fullvalue = $value;
					}
					$maxcost = $this->HDPCore->getAttributeValue($attributes, 'MAXCOST', 0);
					$subcost = 0;
					if (array_key_exists('ADDER', $fullvalue)) {
						foreach ($fullvalue['ADDER'] as $subkey => $subvalue) {
							if ($subkey === 'attributes') {
								$subattributes = $subvalue;
							} else {
								$subattributes = $this->HDPCore->hasAttributes($subvalue);
							}
							$extras[] = $subattributes['ALIAS'] == 'Other' ? $subattributes['INPUT'] : $subattributes['ALIAS'];
							$subcost += $subattributes['BASECOST'];
						}
						$cost += min($maxcost, $subcost);
					} else {
						$extras[] = $attributes['ALIAS'] == 'Other' ? $attributes['INPUT'] : $attributes['ALIAS'];
						$cost += $this->HDPCore->getAttributeValue($attributes, 'BASECOST', 0);
					}
				}
			}
		}
		return array('display' => $display, 'familiarity' => $familiarity, 'characteristic' => $characteristic, 'roll' => true, 'basecost' => $basecost,  'levels' => $levels,  'lvlval' => $lvlval, 'cost' => $cost, 'type' => $type, 'id' => $xmlid);
	}

	function getFamiliaritySkillDisplay($familiarity) {
		$initialattributes = $familiarity['attributes'];
		$xmlid = $initialattributes['XMLID'];
		$display = $initialattributes['DISPLAY'];
		$extras = array();
		$cost = $this->HDPCore->getAttributeValue($initialattributes, 'BASECOST', 0);
		if (array_key_exists('ADDER', $familiarity)) {
			foreach ($familiarity['ADDER'] as $key => $value) {
				if ($key !== 'ADDER') {
					if ($key === 'attributes') {
						$attributes = $value;
						$fullvalue = $familiarity['ADDER'];
					} else {
						$attributes = $this->HDPCore->hasAttributes($value);
						$fullvalue = $value;
					}
					$maxcost = $this->HDPCore->getAttributeValue($attributes, 'MAXCOST', 0);
					$subcost = 0;
					if (array_key_exists('ADDER', $fullvalue)) {
						foreach ($fullvalue['ADDER'] as $subkey => $subvalue) {
							if ($subkey === 'attributes') {
								$subattributes = $subvalue;
							} else {
								$subattributes = $this->HDPCore->hasAttributes($subvalue);
							}
							$extras[] = $subattributes['ALIAS'] == 'Other' ? $subattributes['INPUT'] : $subattributes['ALIAS'];
							$subcost += $subattributes['BASECOST'];
						}
						$cost += min($maxcost, $subcost);
					} else {
						$extras[] = $attributes['ALIAS'] == 'Other' ? $attributes['INPUT'] : $attributes['ALIAS'];
						$cost += $this->HDPCore->getAttributeValue($attributes, 'BASECOST', 0);
					}
				}
			}
		}
		$returnarray = array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'familiarity', 'extras' => $extras, 'id' => $xmlid);
		return $returnarray;
	}

	function getListSkillDisplay($list, $prefix) {
		$attributes = $list['attributes'];
		$xmlid = $attributes['XMLID'];
		$extras = array();
		$display = $prefix . $attributes['NAME'];
//		$name = explode(":", $attributes['NAME']);
//		$display = trim($name[0]);
		$extras[] = "QTY: " . $attributes['LEVELS'];
		$extras[] = $attributes['DISPLAY'];
//		if(count($name) > 1){
//			$extras[] = trim($name[1]);
//		}
		$cost = $attributes['LEVELS'] * $attributes['LVLCOST'];
		return array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'level', 'extras' => $extras, 'id' => $xmlid);
	}

	function getBackgroundSkillDisplay($skill) {
		$attributes = $skill['attributes'];
		$extras = array();
		$xmlid = $attributes['XMLID'];
		$display = $attributes['ALIAS'] . ": " . $attributes['INPUT'];
		$familiarity = $this->HDPCore->getAttributeValue($attributes, 'FAMILIARITY', false);
		$type = $attributes['ALIAS'];
		$basecost = $attributes['BASECOST'];
		$levels = $attributes['LEVELS'];
		$lvlval = $attributes['LVLVAL'];
		$characteristic = $this->HDPCore->getAttributeValue($attributes, 'CHARACTERISTIC', false);
		$lvlcost = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST', 1);
		$cost = max(0, $basecost + ($levels * $lvlcost));
		return array('display' => $display, 'familiarity' => $familiarity, 'characteristic' => $characteristic, 'roll' => true, 'basecost' => $basecost,  'levels' => $levels,  'lvlval' => $lvlval, 'cost' => $cost, 'type' => $type, 'id' => $xmlid);
	}

	function getSkillDisplay($skill) {
		$attributes = $skill['attributes'];
		$extras = array();
		$xmlid = $attributes['XMLID'];
		$display = $attributes['DISPLAY'];
		if (array_key_exists('INPUT', $attributes)) {
			$display .= " - " . $attributes['INPUT'];
		}
		$familiarity = $this->HDPCore->getAttributeValue($attributes, 'FAMILIARITY', false);
		$type = "skill";
		$basecost = $attributes['BASECOST'];
		$levels = $attributes['LEVELS'];
		$lvlval = $attributes['LVLVAL'];
		$characteristic = $this->HDPCore->getAttributeValue($attributes, 'CHARACTERISTIC', false);
		$lvlcost = $this->HDPCore->getAttributeValue($attributes, 'LVLCOST', 1);
		$cost = max(0, $basecost + ($levels * $lvlcost));
		return array('display' => $display, 'familiarity' => $familiarity, 'characteristic' => $characteristic, 'roll' => true, 'basecost' => $basecost,  'levels' => $levels,  'lvlval' => $lvlval, 'cost' => $cost, 'type' => $type, 'id' => $xmlid);
	}

	function getLanguageDisplay($language) {
		$extras = array();
		$attributes = $language['attributes'];
		$xmlid = $attributes['XMLID'];
		$display = $attributes['ALIAS'] . ": " . $attributes['INPUT'];
		$type = $attributes['ALIAS'];
		$cost = max($attributes['BASECOST'] - ($attributes["NATIVE_TONGUE"] == 'Yes' ? 4 : 0),0);
		if (array_key_exists('ADDER', $language)) {
			if ($this->HDPCore->hasAttributes($language['ADDER'])) {
				$extras[] = $language['ADDER']['attributes']['DISPLAY'];
				$cost += $language['ADDER']['attributes']['BASECOST'];
			}
		}
		return array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'language', 'extras' => $extras, 'id' => $xmlid);
	}

	function getNoRollSkillDisplay($nrs) {
		if ($this->HDPCore->hasAttributes($nrs)) {
			$attributes = $nrs['attributes'];
		} else {
			foreach ($nrs as $nrskey => $nrsvalue) {
				if ($this->HDPCore->hasAttributes($nrsvalue)) {
					$attributes = $nrsvalue['attributes'];
					$nrs = $nrsvalue;
					break;
				}
			}
		}
		$xmlid = $attributes['XMLID'];
		$display = $attributes['DISPLAY'] == $attributes['ALIAS'] ? $attributes['ALIAS'] : $attributes['ALIAS'] . " - " . $attributes['DISPLAY'];
		$cost = $attributes['BASECOST'] * 1;
		$extras = array();
		if (array_key_exists('NOTES', $nrs)) {
			$extras[] = $nrs['NOTES'];
		}
		if (array_key_exists('LIMITEDPOWER', $nrs)) {
			foreach ($nrs['LIMITEDPOWER'] as $lpkey => $lpvalue) {
				$lpattributes = $lpvalue['attributes'];
				$extras[] = $lpattributes['COMMENTS'];
				$costadjustment = 1 / (-($lpattributes['BASECOST'] * 1) + 1);
				$cost = $cost * $costadjustment;
			}
		}
		return array('display' => $display, 'cost' => $cost, 'roll' => null, 'type' => 'level', 'extras' => $extras, 'id' => $xmlid);
	}

	function getCharacteristicDisplay($characteristic, $max) {
		$attributes = $characteristic['attributes'];
		$display = $attributes['DISPLAY'];
		$value = $attributes['BASE'] + ($attributes['LEVELS']);
		$cost = $attributes['LEVELS'] * $attributes['LVLCOST'];
		if ($attributes['POSITION'] < 7) {
			$roll = 9 + round($value / 5);
		} else {
			$roll = null;
		}
		return array('stat' => $display, 'value' => $value, 'cost' => $cost, 'roll' => $roll);
	}


}
