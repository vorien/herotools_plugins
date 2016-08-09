<?php

/**
 * CakePHP NodeStack Class
 * @author Michael Coury
 */
class NodeStack {

	public $skipemptynodes = '/node()[not(self::text()[not(normalize-space())])]';
	public $skipempty = '[not(self::text()[not(normalize-space())])]';
	public $tag;
	public $attributes;
	public $node;

	function __construct() {
		
	}

	function findInStack(&$nodestack, $tag) {
		$tagkey = false;
		foreach ($nodestack as $npkey => $npvalue) {
			if (isset($npvalue['tag'])) {
				if ($npvalue['tag'] == $tag) {
					$tagkey = $npkey;
					break;
				}
			} else {
				die('ERROR: nodepath item has no tag value');
			}
		}
		return $tagkey;
	}

	function getRebasedNodeStack(&$nodestack, $newbase = 'MODIFIER', $prepath = '/HEROCSHEET/MODIFIERS') {
		$tagkey = $this->findInStack($nodestack, $newbase);
		if ($tagkey === false) {
			die('ERROR: modifierpath is empty, should not be possible if newbase tag existed in nodepath');
		}
		$modifierstack = array_slice($nodestack, $tagkey);
		if ($prepath) {
			$prestack = $this->parseNodeString($prepath);
			foreach (array_reverse($prestack) as $item) {
				array_unshift($modifierstack, $item);
			}
		}
		return $modifierstack;
	}

	function parseNodeString($string) {
		$nodestack = [];
		$rx_tag = "/^([^\[]+)/";
		$rx_attributes = "/\@(\w+)\s*\=\s*[\"|']([^\"|']*)[\"|']/";
		$rx_brackets = "/\[([0-9]+)\]/";
		$queryarray = explode('/', $string);
		foreach ($queryarray as $item) {
			if ($item) {
				$itemarray = [];
				if (preg_match($rx_tag, $item, $tag)) {
					$itemarray['tag'] = $tag[1];
					if (preg_match_all($rx_attributes, $item, $attributes, PREG_SET_ORDER)) {
						$itemarray['attributes'] = [];
						foreach ($attributes as $attribute) {
							$itemarray['attributes'][] = $attribute[0];
						}
					} else if (preg_match_all($rx_brackets, $item, $brackets, PREG_SET_ORDER)) {
						$itemarray['brackets'] = $brackets[1];
					}
					$nodestack[] = $itemarray;
				} else {
					die('No Tag Found');
				}
			}
		}
		return $nodestack;
	}

	function createTemporaryElement($name, $attributes = []) {
		$tempdoc = new \DOMDocument();
		$tempelement = $tempdoc->createElement($name);
		foreach ($attributes as $akey => $avalue) {
			$tempelement->setAttribute($akey, $avalue);
		}
		return $tempelement;
	}

	function addQueryLevel(&$nodestack, &$node, $attributes = []) {
		$rx_node = "/(\w+)(?:\[([0-9]+)\])?$/";
		if (preg_match($rx_node, $node->getNodePath(), $nodeinfo)) {
			if ($nodeinfo[1]) {
				$itemarray['tag'] = $nodeinfo[1];
				if (count($nodeinfo) == 3) {
					$itemarray['brackets'] = $nodeinfo[2];
				}
			} else {
				die('No Tag Found');
			}
		} else {
			die('No Match Found');
		}
		if ($attributes) {
			foreach ($attributes as $attribute) {
				if ($node->hasAttribute($attribute)) {
					$itemarray['attributes'][] = '@' . $attribute . " = '" . $node->getAttribute($attribute) . "'";
				}
			}
		}
		$newstack = $nodestack;
		$newstack[] = $itemarray;
		return $newstack;
	}

	function removeQueryLevel(&$nodestack) {
		array_pop($nodestack);
	}

	function buildNodeString(&$nodestack, $usebrackets = false) {
		$nodestring = '';
		foreach ($nodestack as $node) {
			$nodestring .= '/' . $node['tag'];
			if ($usebrackets) {
				if (array_key_exists('brackets', $node)) {
					$nodestring .= '[' . $node['brackets'] . ']';
				}
			} else {
				if (array_key_exists('attributes', $node) && !empty($node['attributes'])) {
					$nodestring .= '[' . implode(' and ', $node['attributes']) . ']';
				}
			}
		}
		return $nodestring;
	}

//	function buildNodeArray(&$nodestack) {
//		$nodearray = ['base' => '', 'attributes' => []];
//		foreach ($nodestack as $nkey => $node) {
//			$nodearray['base'] .= '/' . $node['tag'];
//			if (array_key_exists('attributes', $node) && !empty($node['attributes'])) {
//				if ($nkey < count($nodestack) - 1) {
//					$nodestring .= '[' . implode(' and ', $node['attributes']) . ']';
//				} else {
//					$nodearray['attributes'] = $node['attributes'];
//				}
//			}
//		}
//		return $nodearray;
//	}
}

function testNodeStackClassLoad() {
	debug('Load successful');
}
