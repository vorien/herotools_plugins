<?php

namespace Vorien\HeroCombat\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * CakePHP Ownership Component
 * @author Michael
 */
class OwnershipComponent extends Component {

	public $components = array('Auth', 'Flash');

	public function checkCharacterOwnership($characterid = null) {
		if (!$characterid) {
			return false;
		}

		$data = TableRegistry::get('Vorien/HeroCombat.Characters');
		$query = $data->find();
		$query->hydrate(false);
		$query->select(['id', 'userdata_id', 'gm_id']);
//		$query->autofields(true);
		$query->where(['Characters.id' => $characterid]);
		$query->contain([
			'Userdata' => function ($q) {
					return $q->select(['id', 'user_id'])
							->contain(['Users' => function ($q) {
									return $q->select(['id'])->where(['Users.id' => $this->Auth->user('id')]);
								}]);
			},
			'Gms' => function ($q) {
					return $q->select(['id', 'user_id'])
							->contain(['Users' => function ($q) {
									return $q->select(['id'])->where(['Users.id' => $this->Auth->user('id')]);
								}]);
			}
				]);

//			function ($q) use ($characterid) {
//				return $q->where(['Characters.id' => $characterid]);
//			},
//					'Players' => function ($q) use ($characterid) {
//				return $q->where(['Players.id' => $characterid]);
//			}
//				]);
				$result = $query->first();
				if($result['gm']['user'] || $result['userdata']['user']){
					return true;
				} else {
					$this->Flash->set('You need to be the owner or GM to access that character');
					$this->_registry->getController()->redirect($this->Auth->redirectUrl());
				}
			}

			public function checkWeaponOwnership($weaponid) {
				if ($this->request->session()->read("Auth.User.is_admin")) {
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
				if ($this->request->session()->read("Auth.User.is_admin")) {
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
				if ($this->request->session()->read("Auth.User.is_admin")) {
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
				if ($this->request->session()->read("Auth.User.is_admin")) {
					return true;
				}

				if ($this->request->session()->read('Auth.User.id') != $userid) {
					$this->Flash->set('You need to be the User or an Administrator to access that user', 'flash/info');
					return $this->controller->redirect($this->Auth->redirectUrl());
				}
			}

		}
		