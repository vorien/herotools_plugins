<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP PAdderModifierComponent
 * @author Michael
 */
class PAdderModifierComponent extends Component {

	public $components = ['Vorien/HeroCSheet.PCore','Vorien/HeroCSheet.PArray'];

	function getAdders($array, $type = null) {
		$returnarray = $this->PArray->getEmptyAaMArray();
		foreach ($array as $key => $value) {
			$adderarray = $this->getAdder($key, $value);
			$returnarray['cost'] += $adderarray['cost'];
			$returnarray['extras'] = array_unique(array_merge_recursive($returnarray['extras'], $adderarray['extras']));
		}
		return $returnarray;
	}

	function getAdder($key, $value, $type = null, $adderarray = array()) {
		if (!$adderarray) {
			$adderarray = $this->PArray->getEmptyAaMArray();
		}
		if (is_numeric($key)) {
			$key = 'default';
		}
		switch ($key) {
			case "attributes":
				$adderarray['cost'] += $this->PCore->getCost($value);
				$adderarray['extras'] = array_unique(array_merge_recursive($adderarray['extras'], $this->PCore->getAdderExtras($value, ($type == 'power' ? "A" : null))));
				break;
			case "ADDER":
				$adderarray = $this->getAdders($value, $adderarray);
				break;
			case 'NOTES':
				$adderarray['extras'][] = $value;
				break;
			default:
				if (is_array($value)) {
					foreach ($value as $s_key => $s_value) {
						$adderarray = $this->getAdder($s_key, $s_value, $adderarray);
					}
				}
				break;
		}
		return $adderarray;
	}

	function getModifiers($array, $type = null) {
		$returnarray = $this->PArray->getEmptyAaMArray();
		foreach ($array as $key => $value) {
			$modifierarray = $this->getModifier($key, $value, $type);
			$returnarray = $this->PCore->addModifierCost($modifierarray['cost'], $returnarray);
			$returnarray['extras'] = array_unique(array_merge_recursive($returnarray['extras'], $modifierarray['extras']));
		}
		return $returnarray;
	}

	function getModifier($key, $value, $type = null, $modifierarray = array()) {
		if (!$modifierarray) {
			$modifierarray = $this->PArray->getEmptyAaMArray();
		}
		if (is_numeric($key)) {
			$key = 'default';
		}
		switch ($key) {
			case "attributes":
				$modifierarray['cost'] += $this->PCore->getCost($value);
				$modifierarray['extras'] = array_unique(array_merge_recursive($modifierarray['extras'], $this->PCore->getModifierExtras($value, ($type == 'power' ? "M" : null))));
				break;
			case "ADDER":
				$adderarray = $this->getAdders($value, $modifierarray, $type);
				$modifierarray['cost'] += $adderarray['cost'];
				$modifierarray['extras'] = array_unique(array_merge_recursive($modifierarray['extras'], $adderarray['extras']));
				break;
			case 'NOTES':
				$modifierarray['extras'][] = $value;
				break;
			default:
				if (is_array($value)) {
					foreach ($value as $s_key => $s_value) {
						$modifierarray = $this->getModifier($s_key, $s_value, $type, $modifierarray);
					}
				}
				break;
		}
		return $modifierarray;
	}


}
