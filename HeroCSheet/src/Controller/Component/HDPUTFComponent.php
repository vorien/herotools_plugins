<?php

namespace MFC\HDParser\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HCUTFComponent
 * @author Michael
 */
class HCUTFComponent extends Component {

	public $components = array();

	public function initialize($controller) {
		
	}

	public function startup($controller) {
		
	}

	public function beforeRender($controller) {
		
	}

	public function shutDown($controller) {
		
	}

	public function beforeRedirect($controller, $url, $status = null, $exit = true) {
		
	}

	function arrayToUTF8($array) {
		array_walk_recursive($array, function(&$item, $key) {
			if (!mb_detect_encoding($item, 'utf-8', true)) {
				$item = utf8_encode($item);
			}
		});

		return $array;
	}

}
