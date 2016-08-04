<?php

namespace Vorien\Dashboard\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

/**
 * CakePHP Ownership Component
 * @author Michael
 */
class CharacterOwnershipComponent extends Component {

	public $components = ['Auth', 'Flash'];

	public function checkCharacterOwnership($characterid = null) {
		if (!$characterid) {
			return false;
		}

		$data = TableRegistry::get('Vorien/Dashboard.Characters');
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

								$result = $query->first();
								if ($result['gm']['user'] || $result['userdata']['user']) {
									return true;
								} else {
									$this->Flash->set('You need to be the owner or GM to access that character');
									$this->_registry->getController()->redirect($this->Auth->redirectUrl());
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
						