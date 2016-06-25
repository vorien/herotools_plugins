<?php

namespace Vorien\HeroCombat\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function beforeRender(Event $event){
		$this->viewBuilder()->layout('Vorien/HeroCombat.default');
	}

   public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['']);
    }

}
