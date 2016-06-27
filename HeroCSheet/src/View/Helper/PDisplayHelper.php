<?php
namespace Vorien\HeroCSheet\View\Helper;

use Cake\View\Helper;

/**
 * CakePHP PDisplayHelper
 * @author Michael
 */
class PDisplayHelper extends Helper {

	public $helpers = array();

	function removeModifierValue(&$value, $key) {
//		echo($value . "<br>");
		$pattern = "/\s*(A?|M?)\(-?[0-9]+(\.?[0-9]+)?\)\s*/";
		$value = preg_replace($pattern, '', $value);
//		echo($value . "<br>");
	}

	function removeLeadingParen(&$value, $key) {
		if (substr($value, 0, 1) == '(' && substr($value, -1, 1) != ')') {
			$value = substr($value, 1);
		}
//		echo($value . "<br>");
	}

	function displayExtras($array, $removeleadingparen = null) {
		if (array_key_exists('extras', $array) && !empty($array['extras'])) {
			$extras = $array['extras'];
//			pr($extras);
			array_walk($extras, array($this, 'removeModifierValue'));
//			pr($extras);
			if ($removeleadingparen) {
				array_walk($extras, array($this, 'removeLeadingParen'));
			}
			$return = implode(', ', $extras);
		} else {
			$return = "&nbsp;";
		}
		return $return;
	}

	function getSkillRoll($skill, $characteristics) {
		if (array_key_exists('roll', $skill) && $skill['roll']) {
			if ($skill['familiarity'] == 'Yes') {
				return "8-";
			} elseif ($characteristics && array_key_exists($skill['characteristic'], $characteristics)) {
				$baseroll = $characteristics[$skill['characteristic']]['roll'];
			} else {
				$baseroll = 11;
			}
			$roll = $baseroll + $skill['levels'];
			if ($roll > 14) {
				$roll = 14 + floor(($roll - 14) / 2);
			}
			return $roll . "-";
		} else {
			return null;
		}
	}

}
