<?php

namespace Vorien\HeroCombat\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;



/**
 * CakePHP ActiveCharacterComponent
 * @author Michael
 */
class ActiveCharacterComponent extends Component {

	public $components = array('Session');

	function setActiveCharacter($characterid = null) {
		if(!$characterid){
			return false;
		}
		$data = TableRegistry::get('Vorien/HeroCombat.Characters');
		$query = $data->find();
		$query->hydrate(false);
		$query->where(['Characters.id' => $characterid]);
		$result = $query->all()->toArray();
		Cache::write('character', $result);
	}

}
