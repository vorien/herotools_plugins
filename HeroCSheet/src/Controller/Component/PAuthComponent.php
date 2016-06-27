<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP PAuthComponent
 * @author Michael
 */
class PAuthComponent extends Component {

	public $components = array('Session', 'Auth');

	public function initialize(&$controller, $settings = array()) {
		$this->controller = $controller;
	}

	public function checkCharacterOwnership($characterid) {
		if($this->Session->read("Auth.User.is_admin")){
			return true;
		}
		
		$model = ClassRegistry::init('Character');

		if (!$model->exists($characterid)) {
			$this->Flash->set('Character not found', 'flash/error');
			return $this->controller->redirect($this->Auth->redirectUrl());
		}

		$options = array(
			'conditions' => array(
				'Character.id' => $characterid,
				"OR" => array(
					"Character.user_id" => $this->Auth->user('id'),
					"Character.gm_id" => $this->Auth->user('id')
				)
			)
		);

		if ($model->find('count', $options) == 0) {
			$this->Flash->set('You need to be the owner or GM to access that character', 'flash/info');
			$this->controller->redirect($this->Auth->redirectUrl());
		}
	}

	public function checkWeaponOwnership($weaponid) {
		if($this->Session->read("Auth.User.is_admin")){
			return true;
		}

		$model = ClassRegistry::init('Characterweapon');

		if (!$model->exists($weaponid)) {
			$this->Flash->set('Weapon not found', 'flash/error');
			return $this->controller->redirect($this->Auth->redirectUrl());
		}

		$options = array(
			'contain' => array('Character'),
			'conditions' => array(
				'Characterweapon.id' => $weaponid,
				"OR" => array(
					"Character.user_id" => $this->Auth->user('id'),
					"Character.gm_id" => $this->Auth->user('id')
				)
			)
		);

		if ($model->find('count', $options) == 0) {
			$this->Flash->set('You need to be the owner or GM to access that weapon', 'flash/info');
			$this->controller->redirect($this->Auth->redirectUrl());
		}
	}

	public function checkLevelOwnership($levelid) {
		if($this->Session->read("Auth.User.is_admin")){
			return true;
		}

		$model = ClassRegistry::init('Characterlevel');

		if (!$model->exists($levelid)) {
			$this->Flash->set('Level not found', 'flash/error');
			return $this->controller->redirect($this->Auth->redirectUrl());
		}

		$options = array(
			'contain' => array('Character'),
			'conditions' => array(
				'Characterlevel.id' => $levelid,
				"OR" => array(
					"Character.user_id" => $this->Auth->user('id'),
					"Character.gm_id" => $this->Auth->user('id')
				)
			)
		);

		if ($model->find('count', $options) == 0) {
			$this->Flash->set('You need to be the owner or GM to access that weapon', 'flash/info');
			$this->controller->redirect($this->Auth->redirectUrl());
		}
	}

	public function checkManeuverOwnership($maneuverid) {
		if($this->Session->read("Auth.User.is_admin")){
			return true;
		}

		$model = ClassRegistry::init('Charactermaneuver');

		if (!$model->exists($maneuverid)) {
			$this->Flash->set('Maneuver not found', 'flash/error');
			return $this->controller->redirect($this->Auth->redirectUrl());
		}

		$options = array(
			'contain' => array('Character'),
			'conditions' => array(
				'Charactermaneuver.id' => $maneuverid,
				"OR" => array(
					"Character.user_id" => $this->Auth->user('id'),
					"Character.gm_id" => $this->Auth->user('id')
				)
			)
		);

		if ($model->find('count', $options) == 0) {
			$this->Flash->set('You need to be the owner or GM to access that maneuver', 'flash/info');
			$this->controller->redirect($this->Auth->redirectUrl());
		}
	}

	public function checkUserOwnership($userid) {
		if($this->Session->read("Auth.User.is_admin")){
			return true;
		}

		if($this->Session->read('Auth.User.id') != $userid){
			$this->Flash->set('You need to be the User or an Administrator to access that user', 'flash/info');
			return $this->controller->redirect($this->Auth->redirectUrl());
		}
	}

}
