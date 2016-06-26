<?php

namespace MFC\HDParser\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HDPArrayComponent
 * @author Michael
 */
class HDPArrayComponent extends Component {

//	public $components = array();

	function multiKeyExists(Array $array, $key) {
		if (array_key_exists($key, $array)) {
			return true;
		}
		foreach ($array as $k => $v) {
			if (!is_array($v)) {
				continue;
			}
			if (array_key_exists($key, $v)) {
				return true;
			}
		}
		return false;
	}

	function searchArrayValueByKey(array $array, $search) {
		foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
			if ($search === $key)
				return $value;
		}
		return false;
	}

	function resetReturnArray($returnarray) {
		return array('display' => null, 'cost' => array('cost' => 0, 'advantages' => 0, 'limitations' => 0), 'roll' => null, 'type' => 'power', 'extras' => array());
	}

	function getEmptySectionArray($type = null) {
		return array(
			'xmlid' => null, 
			'display' => null, 
			'alias' => null, 
			'cost' => 0, 
			'roll' => null, 
			'levels' => 0, 
			'lvlcost' => 0, 
			'option' => null, 
			'option' => null, 
			'optionid' => null, 
			'optionalias' => null, 
			'option' => null, 
			'inputlabel' => null, 
			'input' => null, 
			'name' => null, 
			'type' => $type, 
			'extras' => array()
			);
	}

	function getEmptyAaMArray() {
		return array('cost' => 0, 'advantages' => 0, 'limitations' => 0, 'extras' => array());
	}

	function getArrayTopKeys(array $array) {
		foreach ($array as $key => $value) {
			echo($key . "<br>\n");
		}
	}

	function getArrayKeys(array $array, $depth = 0) {
		foreach ($array as $key => $value) {
			echo "<p>" . str_repeat("&nbsp;", $depth * 5) . $key . ": " . (empty($value) ? " is " : "is not ") . "empty -- " . (is_array($value) ? " is " : "is not ") . "array" . (!is_array($value) && !empty($value) ? " length = " . strlen($value) . " vs " . strlen(trim($value)) : "") . "</p>";
			if (is_array($value)) {
				$this->getArrayKeys($value, $depth + 1);
			}
		}
	}

	function removeEmptyArrayKeys(array $array) {
		$outarray = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				if (empty($value)) {
					continue;
				} else {
					$subarray = $this->removeEmptyArrayKeys($value);
					if ($subarray !== false) {
						if (strpos($key, 'attributes') !== false) {
							$key = 'attributes';
						}
						$outarray[$key] = $subarray;
					} else {
						continue;
					}
				}
			} else {
				if (strlen(trim($value)) > 0) {
					$outarray[$key] = $value;
				} else {
					continue;
				}
			}
		}
		if (!empty($outarray)) {
			return $outarray;
		} else {
			return false;
		}
	}

	function getArrayKeyCount($array) {
		$count = 0;
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				if ($key == 'attributes') {
					$count += 1;
				} else {
					$count += $this->getArrayKeyCount($value);
				}
			} else {
				$count += 1;
			}
		}
		return $count;
	}

	function getArrayKeysExtended(array $array, $depth) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				if (array_key_exists(0, $value)) {
					foreach ($value as $subvalue) {
						if (is_array($subvalue)) {
							if (isset($subvalue['attributes']['XMLID'])) {
								echo "<p>" . str_repeat("&nbsp;", $depth * 5) . $subvalue['attributes']['XMLID'] . "</p>";
							}
							$this->getArrayKeys($subvalue, $depth + 1);
						}
					}
				} else {
					echo "<p>" . str_repeat("&nbsp;", $depth * 5) . $key . "</p>";
					if (is_array($value)) {
						$this->getArrayKeys($value, $depth + 1);
					}
				}
			}
		}
	}

	/**
	 * Searches haystack for needle and 
	 * returns an array of the key path if 
	 * it is found in the (multidimensional) 
	 * array, FALSE otherwise.
	 *
	 * @mixed array_searchRecursive ( mixed needle, 
	 * array haystack [, bool strict[, array path]] )
	 */
	function array_searchRecursive($needle, $haystack, $strict = false, $path = array()) {
		if (!is_array($haystack)) {
			return false;
		}

		foreach ($haystack as $key => $val) {
			if (is_array($val) && $subPath = array_searchRecursive($needle, $val, $strict, $path)) {
				$path = array_merge($path, array($key), $subPath);
				return $path;
			} elseif ((!$strict && $val == $needle) || ($strict && $val === $needle)) {
				$path[] = $key;
				return $path;
			}
		}
		return false;
	}

	/**
	 * Recursively searches a multidimensional array for a key and optional value and returns the path as a string representation or subset of the array or a value.
	 * 
	 * @author  Akin Williams <aowilliams@arstropica.com>
	 * 
	 * @param   int|string $needle Key
	 * @param   array $haystack Array to be searched
	 * @param   bool $strict Optional, limit to keys of the same type. Default false.
	 * @param   string $output Optional, output key path as a string representation or array subset, ('array'|'string'|'value'). Default array.
	 * @param   bool $count Optional, append number of matching elements to result. Default false.
	 * @param   int|string $value Optional, limit results to keys matching this value. Default null.
	 * @return  array Array containing matching keys and number of matches
	 * */
	function multi_array_key_search($needle, $haystack, $strict = false, $output = 'array', $count = false, $value = null) {
		// Sanity Check
		if (!is_array($haystack))
			return false;

		$resIdx = 'matchedIdx';
		$prevKey = "";
		$keys = array();
		$num_matches = 0;

		$numargs = func_num_args();
		if ($numargs > 6) {
			$arg_list = func_get_args();
			$keys = $arg_list[6];
			$prevKey = $arg_list[7];
		}

		$keys[$resIdx] = isset($keys[$resIdx]) ? $keys[$resIdx] : 0;

		foreach ($haystack as $key => $val) {
			if (is_array($val)) {
				if ((($key === $needle) && is_null($value)) || (($key === $needle) && ($val[$key] == $value) && $strict === false) || (($key === $needle) && ($val[$key] === $value) && $strict === true)) {
					if ($output == 'value') {
						$keys[$keys[$resIdx]] = $val;
					} else {
						$keys[$keys[$resIdx]] = $prevKey . (isset($keys[$keys[$resIdx]]) ? $keys[$keys[$resIdx]] : "") . "[\"$key\"]";
					}
					$keys[$resIdx] ++;
				}
				$passedKey = $prevKey . "[\"$key\"]";
				;
				$keys = $this->multi_array_key_search($needle, $val, $strict, $output, true, $value, $keys, $passedKey);
			} else {
				if ((($key === $needle) && is_null($value)) || (($key === $needle) && ($val == $value) && $strict === false) || (($key === $needle) && ($val === $value) && $strict === true)) {
					if ($output == 'value') {
						$keys[$keys[$resIdx]] = $val;
					} else {
						$keys[$keys[$resIdx]] = $prevKey . (isset($keys[$keys[$resIdx]]) ? $keys[$keys[$resIdx]] : "") . "[\"$key\"]";
					}
					$keys[$resIdx] ++;
				}
			}
		}
		if ($numargs < 7) {
			$num_matches = (count($keys) == 1) ? 0 : $keys[$resIdx];
			if ($count)
				$keys['num_matches'] = $num_matches;
			unset($keys[$resIdx]);
			if (($output == 'array') && $num_matches > 0) {
				if (is_null($value)) {
					$replacements = $this->multi_array_key_search($needle, $haystack, $strict, 'value', false);
				}
				$arrKeys = ($count) ? array('num_matches' => $num_matches) : array();
				for ($i = 0; $i < $num_matches; $i ++) {
					$keysArr = explode(',', str_replace(array('][', '[', ']'), array(',', '', ''), $keys[$i]));
					$json = "";
					foreach ($keysArr as $nestedkey) {
						$json .= "{" . $nestedkey . ":";
					}
					if (is_null($value)) {
						$placeholder = time();
						$json .= "\"$placeholder\"";
					} else {
						$json .= "\"$value\"";
					}
					foreach ($keysArr as $nestedkey) {
						$json .= "}";
					}
					$arrKeys[$i] = json_decode($json, true);
					if (is_null($value)) {
						array_walk_recursive($arrKeys[$i], function (&$item, $key, &$userdata) {
							if ($item == $userdata['placeholder'])
								$item = $userdata['replacement'];
						}, array('placeholder' => $placeholder, 'replacement' => $replacements[$i]));
					}
				}
				$keys = $arrKeys;
			}
		}
		return $keys;
	}

	function array_filter_recursive($input) {
		foreach ($input as &$value) {
			if (is_array($value)) {
				$value = $this->array_filter_recursive($value);
			}
		}

		return array_filter($input);
	}

	function array_diff_keys_multi($array1, $array2) {
		$result = array();
		foreach ($array1 as $key => $val) {
			if (isset($array2[$key])) {
				if (is_array($val) && $array2[$key]) {
					$result[$key] = $this->array_diff_keys_multi($val, $array2[$key]);
				}
			} else {
				$result[$key] = $val;
			}
		}

		return $result;
	}

	function print_r_tree($data) {
// capture the output of print_r
		$out = print_r($data, true);

// replace something like '[element] => <newline> (' with <a href="javascript:toggleDisplay('...');">...</a><div id="..." style="display: none;">
		$out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe', "'\\1<a href=\"javascript:toggleDisplay(\''.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\">\\2</a><div id=\"'.\$id.'\" style=\"display: none;\">'", $out);

// replace ')' on its own on a new line (surrounded by whitespace is ok) with '</div>
		$out = preg_replace('/^\s*\)\s*$/m', '</div>', $out);

// print the javascript function toggleDisplay() and then the transformed output
		echo '<script language="Javascript">function toggleDisplay(id) {
			document.getElementById(id).style.display = (document.getElementById(id).style.display == "block") ? "none" : "block";
		}</script>' . "\n<pre>$out</pre>";
	}

	function objectToArray($object) {
		if (!is_object($object) && !is_array($object))
			return $object;

		return array_map(array($this, 'objectToArray'), (array) $object);
	}

	function array_diff_assoc_recursive($array1, $array2) {
		foreach ($array1 as $key => $value) {
			if (is_array($value)) {
				if (!isset($array2[$key])) {
					$difference[$key] = $value;
				} elseif (!is_array($array2[$key])) {
					$difference[$key] = $value;
				} else {
					$new_diff = $this->array_diff_assoc_recursive($value, $array2[$key]);
					if ($new_diff != FALSE) {
						$difference[$key] = $new_diff;
					}
				}
			} elseif (!isset($array2[$key]) || $array2[$key] != $value) {
				$difference[$key] = $value;
			}
		}
		return !isset($difference) ? 0 : $difference;
	}

	function array_keys_multi(array $array) {
		$keys = array();

		foreach ($array as $key => $value) {
			$keys[] = $key;

			if (is_array($array[$key])) {
				$keys = array_merge($keys, $this->array_keys_multi($array[$key]));
			}
		}

		return $keys;
	}


}
