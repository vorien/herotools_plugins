<?php

namespace MFC\HDParser\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HCActiveCharacterComponent
 * @author Michael
 */
class HCActiveCharacterComponent extends Component {

	public $components = array('Session');

	function setActiveCharacter($characterid) {
		$model = ClassRegistry::init('Character');
		$this->Session->write('Character.active', $characterid);
		$model->id = $characterid;
		if ($charactername = $model->field('name')) {
			$this->Session->write('Character.name', h($charactername));
		}
	}

}
