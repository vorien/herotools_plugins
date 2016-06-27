<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP PCoreComponent
 * @author Michael
 */
class PCoreComponent extends Component {

	public $components = array('HCParserStandardize', 'HCParserSkillDisplay', 'HCParserSections', 'HCParserArray');

	function getRollFromLevels($levels) {
		if ($levels == 1) {
			$roll = 8;
		} else {
			$roll = 11 + ($levels - 2);
		}
		return $roll;
	}

	function getLevelsAndCost($array, $key = null) {
		if (is_array($array)) {
			if ($attributes = $this->hasAttributes($array)) {
				$xmlid = $this->getAttributeValue($attributes, 'XMLID');
				if (!$xmlid) {
					$xmlid = $key;
				}
				$attr['xmlid'] = $xmlid;
				$attr['basecost'] = $this->getAttributeValue($attributes, 'BASECOST');
				$attr['lvlcost'] = $this->getAttributeValue($attributes, 'LVLCOST');
				$attr['levels'] = $this->getAttributeValue($attributes, 'LEVELS');
				$attr['lvlval'] = $this->getAttributeValue($attributes, 'LVLVAL');
				$attr['lvlpower'] = $this->getAttributeValue($attributes, 'LVLPOWER');
				$attr['multiplier'] = $this->getAttributeValue($attributes, 'MULTIPLIER');
//					debug($keys);
				if ($attr['multiplier'] > 0) {
					debug($attr);
					debug($this->getCost($attributes));
				}
			}
			foreach ($array as $key => $value) {
				if ($key !== 'attributes') {
					$this->getLevelsAndCost($value, $key);
				}
			}
		} else {
//			debug($array . " is not an array");
		}
	}

	function getTalentCost($array) {
		$returncost = 0;
		if (is_array($array)) {
			if ($attributes = $this->hasAttributes($array)) {
				$returncost += $this->getCost($attributes);
			}
		}
		foreach ($array as $key => $value) {
			if ($key !== 'attributes') {
				$returncost += $this->getTalentCost($value);
			}
		}
		return $returncost;
	}

	function getAttributesRecursive($array, $return = array()) {
		if ($attributes = $this->hasAttributes($array)) {
			$return[] = $array;
			debug("One adder: " . $p_adderid);
			if ($t_adder = $this->getArrayFromXmlidMatch($p_adderid, $t_adders)) {
				debug($p_adderid . " found");
			} else {
				debug($p_adderid . " NOT found locally");
				if ($t_adder = $this->getArrayFromXmlid($p_adderid, $template)) {
					debug($p_adderid . " found at top level");
				} else {
					debug($p_adderid . " NOT found anywhere");
				}
			}
		} else {
			debug("Multiple adders");
			foreach ($p_adders as $adderkey => $addervalue) {
				$this->getAttributesRecursive($addervalue, $t_adders, $template);
			}
		}
	}

	function getFirstArrayWithXmlidMatch($xmlid, $array) {
		$return = array();
		if ($this->getAttribute('XMLID', $array) == $xmlid) {
			return($array);
		} else {
			if (is_array($array)) {
				foreach ($array as $key => $value) {
					if ($this->hasAttributes($value)) {
						$return = $this->getFirstArrayWithXmlidMatch($xmlid, $value);
						if ($return) {
							break;
						}
					}
				}
			}
		}
		return $return;
	}

	function getArrayFromXmlidMatch($xmlid, $array) {
		if ($this->getAttribute('XMLID', $array) == $xmlid) {
			return($array);
		}
		foreach ($array as $key => $value) {
			if (is_array($value) && $this->getAttribute('XMLID', $value) == $xmlid) {
				return($value);
			}
		}
		return false;
	}

	function getArrayFromXmlid($xmlid, $array) {
		if (array_key_exists($xmlid, $array)) {
			return $array[$xmlid];
		}
		foreach ($array as $key => $value) {
			if (array_key_exists($xmlid, $value)) {
				return $value[$xmlid];
			}
		}
		return false;
	}

	/*
	  [NOTE BY danbrown AT php DOT net: The array_diff_assoc_recursive function is a
	  combination of efforts from previous notes deleted.
	  Contributors included (Michael Johnson), (jochem AT iamjochem DAWT com),
	  (sc1n AT yahoo DOT com), and (anders DOT carlsson AT mds DOT mdh DOT se).]
	 */

	function getCost($attributes) {
		$xmlid = $this->getAttributeValue($attributes, 'XMLID');
		$basecost = $this->getAttributeValue($attributes, 'BASECOST');
		$levels = $this->getAttributeValue($attributes, 'LEVELS');
		$levelstart = $this->getAttributeValue($attributes, 'LEVELSTART');
		$lvlcost = $this->getAttributeValue($attributes, 'LVLCOST', 1);
		$lvlmultiplier = $this->getAttributeValue($attributes, 'LVLMULTIPLIER');
		$lvlpower = $this->getAttributeValue($attributes, 'LVLPOWER');
		$lvlval = $this->getAttributeValue($attributes, 'LVLVAL');

//		echo $xmlid . ';' . $basecost . ';' . $levels . ';' . $levelstart . ';' . $lvlcost . ';' . $lvlmultiplier . ';' . $lvlpower . ';' . $lvlval . '<br>';

		$returncost = 0;
		if ($basecost) {
			$returncost += $basecost;
		}
		if ($levels) {
			if ($lvlmultiplier && $lvlpower) {
				$returncost += ceil(pow($levels / ($lvlmultiplier * $lvlpower), 1 / $lvlpower)) * $lvlcost;
			} elseif ($lvlcost || $lvlval) {
				$returncost += $levels * ($lvlcost ? $lvlcost : 1) / ($lvlval ? $lvlval : 1);
			}
		}

		return $returncost;
//		return $this->getAttributeValue($attributes, 'BASECOST', 0) + ($this->getAttributeValue($attributes, 'LEVELS', 0) * $this->getAttributeValue($attributes, 'LVLCOST', 0));
	}

	function addModifierCost($cost, $costarray) {
		if ($cost > 0) {
			$costarray['advantages'] += $cost;
		} else {
			$costarray['limitations'] -= $cost;
		}
		return $costarray;
	}

	public function getModifiedCost($costarray) {
		$cost = $costarray['cost'] * (1 + $costarray['advantages']) / (1 + $costarray['limitations']);
		$costarray['cost'] = $cost;
		$costarray['advantages'] = 0;
		$costarray['limitations'] = 0;
		return $costarray;
	}

	function getRawExtras($attributes, $type = null) {
		$extrasarray = array();
		if ($attr = $this->getAttributeValue($attributes, 'COMMENTS')) {
			$extrasarray[] = $attr;
		}
		return $extrasarray;
	}

	function getAdderExtras($attributes, $type = null) {
		$extrasarray = array();
		if ($attr = $this->getAttributeValue($attributes, 'OPTION_ALIAS')) {
			if ($type) {
				$attr .= "  " . $type . "(" . $this->getCost($attributes) . ")";
			}
			$extrasarray[] = $attr;
		} else {
			if ($attr = $this->getAttributeValue($attributes, 'ALIAS')) {
				if ($type) {
					$attr .= "  " . $type . "(" . $this->getCost($attributes) . ")";
				}
				$extrasarray[] = $attr;
			}
		}
		if ($attr = $this->getAttributeValue($attributes, 'COMMENTS')) {
			$extrasarray[] = $attr;
		}
		return $extrasarray;
	}

	function getModifierExtras($attributes, $type = null) {
		$extrasarray = array();
		if ($attr = $this->getAttributeValue($attributes, 'OPTION_ALIAS')) {
			if ($type) {
				$attr .= "  " . $type . "(" . $this->getCost($attributes) . ")";
			}
			$extrasarray[] = $attr;
		} else {
			if ($attr = $this->getAttributeValue($attributes, 'ALIAS')) {
				if ($type) {
					$attr .= "  " . $type . "(" . $this->getCost($attributes) . ")";
				}
				$extrasarray[] = $attr;
			}
		}
		if ($attr = $this->getAttributeValue($attributes, 'COMMENTS')) {
			$extrasarray[] = $attr;
		}
		return $extrasarray;
	}

	function getExtras($attributes, $type = null) {
		$extrasarray = array();
		if ($type == 'power') {
			if ($attr = $this->getAttributeValue($attributes, 'OPTION_ALIAS')) {
				$extrasarray[] = $attr . "  " . $type . "(" . $this->getCost($attributes) . ")";
			} else {
				if ($attr = $this->getAttributeValue($attributes, 'ALIAS')) {
					$extrasarray[] = $attr . "  " . $type . "(" . $this->getCost($attributes) . ")";
				}
			}
		}
		if ($attr = $this->getAttributeValue($attributes, 'COMMENTS')) {
			$extrasarray[] = $attr;
		}
		return $extrasarray;
	}

	function hasAttributes($array) {
		if (is_array($array)) {
			if (array_key_exists('attributes', $array)) {
				return $array['attributes'];
			}
		}
		return false;
	}

	function getAttributeValue($attributes, $string, $default = false) {
		if (array_key_exists($string, $attributes)) {
			$outval = $attributes[$string];
			if (is_numeric($outval)) {
				return $outval * 1;
			} else {
				return $outval;
			}
		} else {
			return $default;
		}
	}

	function getFirstAttributes($value) {
		$attributes = array();
		if ($this->hasAttributes($value)) {
			$attributes = $value['attributes'];
		} else {
			if (is_array($value)) {
				foreach ($value as $subkey => $subvalue) {
					$attributes = $this->getFirstAttributes($subvalue);
					if (!empty($attributes)) {
						break;
					}
				}
			}
		}
		return $attributes;
	}

	function getFirstWithAttributes($value) {
		$array = array();
		if (array_key_exists('attributes', $value)) {
			return $value;
		} else {
			if (is_array($value)) {
				foreach ($value as $subkey => $subvalue) {
					$array = $this->getFirstWithAttributes($subvalue);
					if (!empty($array)) {
						break;
					}
				}
			}
		}
		return $array;
	}

	function getFirstKeyValueWithAttributes($value) {
		$array = array();
		$newkey = key($value);
		if (array_key_exists('attributes', $value[$newkey])) {
			return $value;
		} else {
			if (is_array($value)) {
				foreach ($value as $subkey => $subvalue) {
					$array = $this->getFirstKeyValueWithAttributes($subvalue);
					if (!empty($array)) {
						break;
					}
				}
			}
		}
		return $array;
	}

	function getFirstKeyWithAttributes($key, $value) {
		$array = array();
		$newkey = null;
		if ($this->hasAttributes($value)) {
			return $key;
		} else {
			if (is_array($value)) {
				$firstkey = key($value);
				$newkey = $this->getFirstKeyWithAttributes($firstkey, $value[$firstkey]);
				if (!empty($newkey)) {
					return $newkey;
				}
			}
		}
		return $newkey;
	}

	function replaceSpacesWithUnderscores($string) {
		return str_replace(" ", "_", $string);
	}

	function buildTwoKeyAttributeSorter($key1, $key2) {
		return function ($a, $b) use ($key1, $key2) {
			return strcmp($a['attributes'][$key1], $b['attributes'][$key1]) != 0 ? strcmp($a['attributes'][$key1], $b['attributes'][$key1]) : strcmp($a['attributes'][$key2], $b['attributes'][$key2]);
		};
	}

	function buildOneKeyAttributeSorter($key1) {
		return function ($a, $b) use ($key1) {
			return strcmp($a['attributes'][$key1], $b['attributes'][$key1]);
		};
	}

	function buildTwoKeySorter($key1, $key2) {
		return function ($a, $b) use ($key1, $key2) {
			return strcmp($a[$key1], $b[$key1]) != 0 ? strcmp($a[$key1], $b[$key1]) : strcmp($a[$key2], $b[$key2]);
		};
	}

	public function sortOnTwoAttributeKeys(&$array, $key1, $key2) {
		uasort($array, $this->buildTwoKeyAttributeSorter($key1, $key2));
	}

	public function sortOnOneAttributeKey(&$array, $key1, $key2) {
		uasort($array, $this->buildOneKeyAttributeSorter($key1, $key2));
	}

	public function sortOnTwoKeys(&$array, $key1, $key2) {
		uasort($array, $this->buildTwoKeySorter($key1, $key2));
	}

	function moveEnhancers(&$array) {
		foreach ($array['SKILLS'] as $key => $skill) {
			if ($key != 'SKILL') {
				$array['SKILL_ENHANCERS']['ENHANCER'][] = $skill;
				unset($array['SKILLS'][$key]);
			}
		}
	}

	function getXmlidArray($array) {
		$outarray = array();
		foreach ($array as $key => $value) {
			if ($this->hasAttributes($value) && array_key_exists('XMLID', $value['attributes'])) {
				$outarray[$value['attributes']['XMLID']] = 0;
			}
		}
		return $outarray;
	}

	function getTemplateCharacteristicAttributes($key, $value, $template) {
		$returnval = array();
		if ($attributes = $this->hasAttributes($value)) {
			$characteristic = null;
			$characteristicchoice = null;
			if ($characteristic = $this->getAttributeValue($attributes, 'CHARACTERISTIC')) {
				if (array_key_exists($key, $template)) {
					$template = $template[$key];
				}

				if (array_key_exists('CHARACTERISTIC_CHOICE', $template)) {
					$characteristicchoice = $template['CHARACTERISTIC_CHOICE'];
					if (array_key_exists($characteristic, $characteristicchoice)) {
						$characteristicchoice = $characteristicchoice[$characteristic];
						if ($this->hasAttributes($characteristicchoice)) {
							$returnval = $characteristicchoice['attributes'];
						}
					}
				}
			}
		}
		return($returnval);
	}

	function getTemplateOptionAttributes($key, $value, $template) {
		$returnval = array();
		if ($attributes = $this->hasAttributes($value)) {
			$option = null;
			$optionchoice = null;
			if ($option = $this->getAttributeValue($attributes, 'OPTION')) {
				if (array_key_exists($key, $template)) {
					$template = $template[$key];
				}

				if (array_key_exists($option, $template)) {
					$optionchoice = $template[$option];
					if ($this->hasAttributes($optionchoice)) {
						$returnval = $optionchoice['attributes'];
					}
				}
			}
		}
		return($returnval);
	}

	function getTemplateAdderAttributes($key, $value, $template) {
		$returnval = array();
		if ($key === 'ADDER') {
			if ($attributes = $this->hasAttributes($value)) {
				$adder = null;
				$adderchoice = null;
				if ($adder = $this->getAttributeValue($attributes, 'XMLID')) {
					if (array_key_exists($key, $template)) {
						$template = $template[$key];
					}
					if (array_key_exists($adder, $template)) {
						$adderchoice = $template[$adder];
						if ($this->hasAttributes($adderchoice)) {
							$returnval = $adderchoice['attributes'];
						}
					}
				}
			}
		}
		return($returnval);
	}

	function changeAttributeKeys(array $array) {
		$outarray = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				if (strpos($key, 'attributes') !== false) {
					$outarray['attributes'] = $value;
				} else {
					$outarray[$key] = $this->changeAttributeKeys($value);
				}
			} else {
				$outarray[$key] = $value;
			}
		}
		return $outarray;
	}

//	function standardizeArrayOptions(array $array, $prevkey = null) {
//		$outarray = array();
//		foreach ($array as $key => $value) {
//			$newkey = $key;
//			$newattribute = null;
//			echo "key: [$key] starting<br>\n";
//			if (is_array($value)) {
//				if ($key === 'attributes') {
//					echo "key: [$key] dumped - attributes<br>\n";
//					$outarray[$key] = $value;
//				} else if ($key === 'NOTES') {
//					echo "key: [$key] dumped - NOTES<br>\n";
//					$outarray[$key] = $value;
//				} else if ($key === 'ADDER') {
//					$newkey = $this->getAdderAttribute($key, $value);
////						echo "key: [$key] starting<br>\n";
//					echo "key: $key - prevkey: $prevkey<br>\n";
//					pr($value);
//					echo "key: [$key] dumped - ADDER<br>\n";
//					$outarray[$newkey] = $this->standardizeArrayOptions($value, $key);
//				} else {
//					if ($key == 0) {
//						echo "key is $key<br>";
//					} else {
//						echo "key is $key (NOT 0)";
//					}
////						echo "key: [$key] starting<br>\n";
//					echo "key: $key - prevkey: $prevkey<br>\n";
//					if (is_int($key) && $prevkey == 'ADDER') {
//						echo "$key is int() = prevkey is $prevkey<br>";
//						$newkey = $this->getAdderAttribute($prevkey, $value);
//						echo "newkey: $newkey<br>";
//					} else {
//						echo "$key is NOT int() = prevkey is $prevkey<br>";
//						$newkey = $this->getAdderAttribute($key, $value);
//						echo "newkey: $newkey<br>";
//					}
//					$outarray[$newkey] = $this->standardizeArrayOptions($value, $key);
//				}
//			} else {
//				echo "key: [$key] dumped - value not array<br>\n";
//				$outarray[$key] = $value;
//			}
//		}
//		return $outarray;
//	}

	function attributeExists($attribute, $value) {
		if ($attribute) {
			if ($attributes = $this->hasAttributes($value)) {
				if ($attributevalue = $this->getAttributeValue($attributes, $attribute)) {
					return true;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function getAttribute($attribute, $array) {
		if ($attribute) {
			if ($attributes = $this->hasAttributes($array)) {
				return $this->getAttributeValue($attributes, $attribute);
			}
		}
		return false;
	}

	function getAdderAttribute($key, $value) {
		$attribute = null;
		if ($key == 'ADDER') {
			$attribute = 'ALIAS';
		}
		if ($attribute) {
			if (empty($value['attributes'])) {
				return $key;
			} else if (isset($value['attributes'][$attribute])) {
				return $value['attributes'][$attribute];
			} else {
				return $key;
			}
		} else {
			return $key;
		}
	}

	function displaySkillArray(array $array, $search) {
		foreach ($array as $key => $value) {
			if (is_array($value) && strtok($key, " ") == $search) {
				$displayarray = array($key => $value);
				debug($displayarray);
			}
		}
	}

	function debugoutbyvalue($keystowatch, $key, $prevkey, $message, $value = null) {
		if (in_array($key, $keystowatch, true) || in_array($prevkey, $keystowatch, true)) {
			echo($key . ": " . $message . "<br>\n");
			if ($value) {
				pr($value);
			}
		}
	}

}
