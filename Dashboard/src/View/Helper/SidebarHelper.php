<?php

namespace Vorien\Dashboard\View\Helper;

use Cake\View\Helper;
//use Cake\View\View;

/**
 * CakePHP SidebarHelper
 * @author Michael
 */
class SidebarHelper extends Helper {


    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

	public $helpers = ['Html'];
	
	public function buildSidebar($controller, $action, $title, $id = null) {
		echo "	<div id='sidebar' class='col-xs-6'>\n";
		echo "		<div style='height: 20px;'>&nbsp;</div>\n";
		echo "		<div class='actions'>\n";
		echo "			<ul class='list-group'>\n";
		echo "				<li class='list-group-item'>" . $this->Html->link(__('Dashboard'), array('controller' => 'herocombat', 'action' => 'index')) . "</li>\n";
		echo "				<li>&nbsp;</li>\n";
		if ($controller == 'Herocombat') {
			$this->buildSidebarAdd('Characters', $action, 'Character', $id);
		} else {
			switch ($action) {
				case "view":
					$this->buildSidebarEdit($controller, $action, $title, $id);
					$this->buildSidebarAdd($controller, $action, $title, $id);
					$this->buildSidebarIndex($controller, $action, $title, $id);
					break;
				case "add":
					$this->buildSidebarIndex($controller, $action, $title, $id);
					break;
				case "edit":
					$this->buildSidebarIndex($controller, $action, $title, $id);
					$this->buildSidebarAdd($controller, $action, $title, $id);
					break;
				default:
					$this->buildSidebarAdd($controller, $action, $title, $id);
					break;
			}
			echo "				<li>&nbsp;</li>\n";
			if ($controller != "characterweapons") {
				echo "				<li class='list-group-item'>" . $this->Html->link(__('Weapons'), array('controller' => 'characterweapons', 'action' => 'index')) . " </li>\n";
			}
			if ($controller != "characterlevels") {
				echo "				<li class='list-group-item'>" . $this->Html->link(__('Combat Levels'), array('controller' => 'characterlevels', 'action' => 'index')) . " </li>\n";
			}
			if ($controller != "charactermaneuvers") {
				echo "				<li class='list-group-item'>" . $this->Html->link(__('Martial Arts'), array('controller' => 'charactermaneuvers', 'action' => 'index')) . " </li>\n";
			}
			if ($controller != "characters") {
				echo "				<li class='list-group-item'>" . $this->Html->link(__('Character'), array('controller' => 'characters', 'action' => 'view', $this->request->session()->read('Character.active'))) . " </li>\n";
			}
		}
		echo "				<li>&nbsp;</li>\n";
//		echo "				<li class='list-group-item'>" . $this->Html->link(__('Log Out'), array('controller' => 'users', 'action' => 'logout')) . " </li>\n";
		echo "			</ul><!-- /.list-group -->\n";
		echo "		</div><!-- /.actions -->\n";
		echo "	</div><!-- /#sidebar .col-xs-6 -->\n";
	}

	public function buildSidebarIndex($controller, $action, $title, $id) {
		if ($controller != 'characters') {
			echo "				<li class='list-group-item'>" . $this->Html->link(__('List ' . $title . 's'), array('controller' => $controller, 'action' => 'index'), array('class' => '')) . "</li>\n";
		}
	}

	public function buildSidebarAdd($controller, $action, $title, $id) {
		echo "				<li class='list-group-item'>" . $this->Html->link(__('New ' . $title), array('controller' => $controller, 'action' => 'add'), array('class' => '')) . "</li>\n";
	}

	public function buildSidebarEdit($controller, $action, $title, $id) {
		echo "				<li class='list-group-item'>" . $this->Html->link(__('Edit ' . $title), array('controller' => $controller, 'action' => 'edit', $id), array('class' => '')) . "</li>\n";
	}


//	public function __construct(View $View, $settings = array()) {
//		parent::__construct($View, $settings);
//	}
//
//	public function beforeRender($viewFile) {
//		
//	}
//
//	public function afterRender($viewFile) {
//		
//	}
//
//	public function beforeLayout($viewLayout) {
//		
//	}
//
//	public function afterLayout($viewLayout) {
//		
//	}

}
