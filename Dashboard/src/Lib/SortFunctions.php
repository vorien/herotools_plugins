<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SortFunctions
 *
 * @author Michael
 */
class SortFunctions {
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

}
