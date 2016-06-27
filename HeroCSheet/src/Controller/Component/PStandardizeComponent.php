<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP PStandardizeComponent
 * @author Michael
 */
class PStandardizeComponent extends Component {

	public $components = ['PCore'];

	function standardizeTemplate($template, $returnarray = array()) {
		foreach ($template as $key => $value) {
			if (!is_array($value)) {
				$returnarray[$key] = $value;
			} else {
				debug("key: $key");
				if (is_int($key) === false) {
					$newkey = $key;
				} else {
					if ($attributes = $this->PCore->hasAttributes($value)) {
						if ($xmlid = $this->PCore->getAttributeValue($attributes, 'XMLID')) {
							$newkey = $xmlid;
						} else {
							if ($display = $this->PCore->getAttributeValue($attributes, 'DISPLAY')) {
								$newkey = strtoupper($display);
							} else {
								if ($characteristic = $this->PCore->getAttributeValue($attributes, 'CHARACTERISTIC')) {
									$newkey = strtoupper($display);
								} else {
									$newkey = "NO XMLID, DISPLAY or CHARACTERISTIC";
									debug("ERROR: key: $key is int(), no xmlid, display or characteristic");
									debug($attributes);
								}
							}
						}
					} else {
						if (!is_array($value[$key])) {
							$newkey = $value[$key];
						} else {
							$newkey = $value;
							debug("ERROR: key: $key is int(), no attributes");
						}
					}
				}
				$returnarray = $this->standardizeTemplate($value, $returnarray);
			}
		}
		return $returnarray;
	}

	function checkDuplicateXMLID($main, $returnarray = array('depth' => 0, 'newarray' => array())) {
		$displaystep = 5;
		if (is_array($main)) {
			foreach ($main as $key => $value) {
				debug(str_repeat(" ", $returnarray['depth'] * $displaystep) . "key: $key");
				if ($attributes = $this->PCore->hasAttributes($value)) {
					if ($xmlid = $this->PCore->getAttributeValue($attributes, 'XMLID')) {
						debug(str_repeat(" ", $returnarray['depth'] * $displaystep) . "xmlid: $xmlid");
					} else {
						if ($xmlid = $this->PCore->getAttributeValue($attributes, 'DISPLAY')) {
							$xmlid = strtoupper($xmlid);
							debug(str_repeat(" ", $returnarray['depth'] * $displaystep) . "display: $xmlid");
						} else {
							$xmlid = "NO XMLID OR DISPLAY";
							debug(str_repeat(" ", $returnarray['depth'] * $displaystep) . "display: $xmlid");
//							debug($key);
//							debug($attributes);
						}
					}
					if (array_key_exists($xmlid, $returnarray['newarray'])) {
						$returnarray['newarray'][$xmlid] += 1;
					} else {
						$returnarray['newarray'][$xmlid] = 1;
					}
				} else {
					$returnarray['depth'] = $returnarray['depth'] + 1;
					$returnarray = $this->checkDuplicateXMLID($value, $returnarray);
				}
			}
		}
		$returnarray['depth'] = $returnarray['depth'] - 1;
		return $returnarray;
	}

	function standardizeArraySkills(array $array) {
		$outarray = array();
		foreach ($array['SKILLS'] as $key => $value) {
			if (is_array($value) && array_key_exists(0, $value)) {
				foreach ($value as $subvalue) {
					if (is_array($subvalue)) {
						if (isset($subvalue['attributes']['XMLID'])) {
							$extendkey = "";
							if (isset($subvalue['attributes']['OPTION'])) {
								$extendkey = $subvalue['attributes']['OPTION'];
								if (!empty($subvalue['attributes']['NAME'])) {
									$extendkey .= ": " . $subvalue['attributes']['NAME'];
								}
							} else if (isset($subvalue['attributes']['INPUT'])) {
								$extendkey = $subvalue['attributes']['ALIAS'] . ": " . $subvalue['attributes']['INPUT'];
							}
							if ($extendkey) {
								$outarray[$subvalue['attributes']['XMLID']][$extendkey] = $subvalue;
							} else {
								$outarray[$subvalue['attributes']['XMLID']] = $subvalue;
							}
						} else {
							$outarray[$value] = $subvalue;
						}
					} else {
						$outarray[$subkey] = $subvalue;
					}
				}
			} else if ($key == 'attributes') {
				$outarray['attributes'] = $value;
			} else {
				$outarray[$key] = $value;
			}
		}
		return $outarray;
	}

	function standardizeArray(array $array, $prevkey = null) {
		$keystowatch = array();
		$outarray = array();
		foreach ($array as $key => $value) {
			$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Start");
			if (is_array($value)) {
				$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "is array");
				if ($prevkey === 'POWERS' && $key === 'POWER') {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as POWER");
					$outarray[$key] = $this->standardizeArray($value, $key);
				} else if ($key === 'ADDER' || $key === 'MODIFIER') {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as ADDER/MODIFIER");
					$outarray[$key] = $this->standardizeArray($value, $key);
				} else if ($key === 'attributes') {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as attributes");
					$outarray[$key] = $value;
				} else if ($key === 'NOTES') {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as notes");
					$outarray[$key] = $value;
//				} else if ($key === 'CHARACTERISTIC_CHOICE') {
//					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as characteristic_choice");
//					$outarray[$key] = $value;
//				} else if ($key === 'ITEM') {
//					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as item");
//					$outarray[$key] = $value;
				} else if ($key === 'DESCRIPTION') {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as description");
					$outarray[$key] = $value;
//				} else if ($key === 'TYPE') {
//					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as type");
//					$outarray[$key] = $outarray[$key] = $value;
				} else {
					$attr_xmlid = $this->PCore->getAttribute('XMLID', $value);
					$attr_input = $this->PCore->getAttribute('INPUT', $value);
					$attr_option = $this->PCore->getAttribute('OPTION', $value);
					$attr_alias = $this->PCore->getAttribute('ALIAS', $value);
					$attr_name = $this->PCore->getAttribute('NAME', $value);
					$attr_characteristic = $this->PCore->getAttribute('CHARACTERISTIC', $value);
					if ($attr_xmlid) {
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "has xmlid");
						if ($prevkey === $attr_xmlid && !$attr_name && !$attr_option) {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as alias/alias because key is same as prevkey");
							$outarray[$this->PCore->replaceSpacesWithUnderscores(strtoupper($attr_alias))][$this->PCore->replaceSpacesWithUnderscores(strtoupper($attr_alias))] = $this->standardizeArray($value, $key);
						} else if ($attr_xmlid === $key) {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "= xmlid");
							$outarray[$key] = $this->standardizeArray($value, $key);
						} else if ($attr_xmlid === 'OTHER') {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "other dumped as input");
							$outarray[$attr_input] = $this->standardizeArray($value, $key);
						} else if ($attr_xmlid === 'GENERIC_OBJECT') {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "other dumped as input");
							$outarray[strtoupper($attr_alias)] = $this->standardizeArray($value, $key);
						} else if ($this->PCore->attributeExists('INPUT', $value)) {
							if ($this->PCore->attributeExists('NAME', $value)) {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped input:name");
								$outarray[$attr_xmlid][$attr_name] = $this->standardizeArray($value, $key);
							} else {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped input:xmlid");
								$outarray[$attr_xmlid][$attr_input] = $this->standardizeArray($value, $key);
							}
						} else if ($this->PCore->attributeExists('OPTION', $value)) {
							if ($this->PCore->attributeExists('NAME', $value)) {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped option:name");
								$outarray[$attr_xmlid][$attr_option][$attr_name] = $this->standardizeArray($value, $key);
							} else {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped option:xmlid");
								$outarray[$attr_xmlid][$attr_option] = $this->standardizeArray($value, $key);
							}
//						} else if ($prevkey == 'ADDER' && $this->attributeExists('ALIAS', $value)) {
//							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped (from ADDER) alias");
//							$outarray[$attr_alias] = $this->standardizeArray($value, array($attr_alias));
						} else if ($this->PCore->attributeExists('NAME', $value)) {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped xmlid:name");
							$outarray[$attr_xmlid][$attr_name] = $this->standardizeArray($value, $key);
						} else {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped default as xmlid");
							$outarray[$attr_xmlid] = $this->standardizeArray($value, $key);
						}
					} else {
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "has NO xmlid");
						if (count(array_filter(array_keys($value), 'is_int')) > 0) {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "has int keys");
							$outarray = array_merge_recursive($outarray, $this->standardizeArray($value, $key));
//							if (strpos($prevkey, $key) !== false) {
//								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "in $prevkey");
//								$outarray = array_merge_recursive($outarray, $this->standardizeArray($value, $key));
//							} else {
//								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "NOT in $prevkey");
//								$outarray[$prevkey] = $this->standardizeArray($value, $key);
//							}
						} else {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "has NO int keys");
							if (is_int($key) || $key === 'ITEM') {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "is int or ITEM");
								if ($attr_characteristic) {
									$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as characteristic");
									$outarray[$attr_characteristic] = $this->standardizeArray($value, $key);
								}
							} else {
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "is NOT int");
								$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped default as $key");
								$outarray[$key] = $this->standardizeArray($value, $key);
							}
						}
					}
				}
			} else {
				$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "dumped as key to value");
				$outarray[$key] = $value;
			}
		}
		return $outarray;
	}

	function mergeCharacterAndTemplate($array, $template, $prevkey = 'CHARACTER', $attributes = array()) {
		$keystowatch = array();
		$outarray = array();
		foreach ($array as $key => $value) {
			$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Start");
			if ($key === 'attributes') {
				$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "merging in $prevkey attributes");
				$outarray[$key] = array_replace_recursive($attributes, $array[$key]);
				continue;
			} else {
				if (is_array($value)) {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "is array");
					$characteristicattributes = $this->PCore->getTemplateCharacteristicAttributes($key, $value, $template);
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "characteristic attributes created", $characteristicattributes);
					$optionattributes = $this->PCore->getTemplateOptionAttributes($key, $value, $template);
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "option attributes created", $optionattributes);
					$adderattributes = $this->PCore->getTemplateAdderAttributes($key, $value, $template);
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "adder attributes created", $adderattributes);
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "characteristic/option/adder attributes created");
					if ($this->PCore->hasAttributes($value)) {
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "array[$key] has attributes");
					} else {
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "array[$key] has NO attributes");
					}
					if (array_key_exists($key, $template)) {
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "in template");
						if ($this->PCore->hasAttributes($template[$key])) {
							$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "template[$key]  attributes merged");
							$attributes = array_replace_recursive($attributes, $template[$key]['attributes']);
						}
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "merging characteristic/option/adder attributes");
						$attributes = array_replace_recursive($attributes, $characteristicattributes, $optionattributes, $adderattributes);

						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Merging recursive at $key");
						$outarray[$key] = $this->mergeCharacterAndTemplate($value, $template[$key], $key, $attributes);
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Clearing attributes");
						$attributes = array();
					} else {
						$attributes = array_replace_recursive($attributes, $characteristicattributes);
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "NOT in template");
						$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Merging recursive at $key");
						$outarray[$key] = $this->mergeCharacterAndTemplate($value, $template, $key, $attributes);
					}
				} else {
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "is NOT array");
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Dumping at $key");
					$outarray[$key] = $value;
					$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Clearing attributes");
					$attributes = array();
				}
			}
		}
		$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "Clearing attributes");
		$attributes = array();
		$this->PCore->debugoutbyvalue($keystowatch, $key, $prevkey, "returning outarray", $outarray);
		return $outarray;
	}

}
