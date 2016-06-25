<?php

namespace Vorien\Dashboard\View;

use Cake\View\View;

class AppView extends View {

	public function initialize() {
		parent::initialize();
//        $this->loadHelper('Html');
//        $this->loadHelper('Form');
//        $this->loadHelper('Flash');
		$this->loadHelper('Vorien/Dashboard.Display');
		$this->loadHelper('Vorien/Dashboard.ManeuverDisplay');
		$this->loadHelper('Vorien/Dashboard.PageBuild');
		$this->loadHelper('Vorien/Dashboard.SectionBuild');
		$this->loadHelper('Vorien/Dashboard.Sidebar');
	}

}
