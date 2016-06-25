<?php

namespace Vorien\HeroCombat\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * CakePHP ManeuverHelper
 * @author Michael
 */
class ManeuverDisplayHelper extends Helper {

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

//	var $helpers = array('PageBuilder');
	
	public function getHalf($value){
		if($value = .5){
			return "&#189;";
		} else  {
			return $value;
		}		
	}
	
	public function getNegative($value){
		if($value > 0){
			return "+" . $value;
		} else {
			return $value;
		}
	}
	public function getPhaseDisplay($phase){
		return $this->getHalf($phase);
	}
	
	public function getOCVDisplay($action, $value){
		switch($action){
			case "dc":
			case "target":
				return $value . "/" . $action;
				break;
			case "velocity":
				return $value . "/v";
				break;
			case "set":
				return "-> " & $value;
				break;
			default:
				return $this->getNegative($value);
				break;
		}
	}

	public function getDCVDisplay($action, $value){
		switch($action){
			case "mult":
				return "x" . $this->getHalf($value);
				break;
			default:
				return $this->getNegative($value);
				break;
		}
	}


}
