<?php

namespace Vorien\Dashboard\Controller;

use Vorien\Dashboard\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * DashboardController
 * @author Michael
 */
class DashboardController extends AppController {

	public function display() {
		
	}

	public function dashboard() {
		$username = $this->Auth->user('username');
		$data = TableRegistry::get('Vorien/Dashboard.Characters');
		$query = $data->find();
		$query->hydrate(false);
		$query->innerJoinWith('Userdata', function ($q) {
			return $q->where(['Userdata.user_id' => $this->Auth->user('id')]);
		});

		$owncharacters = $query->all();

		$query = $data->find();
		$query->hydrate(false);
		$query->innerJoinWith('Gms', function ($q) {
			return $q->where(['Gms.user_id' => $this->Auth->user('id')]);
		});
		$gmcharacters = $query->all();

		$this->set(compact('owncharacters', 'gmcharacters', 'username'));
	}

}
