<?php

namespace Vorien\HeroCombat\View;

use Cake\View\View;

class AppView extends View {

	public function initialize() {
		parent::initialize();
		$this->loadHelper('SectionBuild');
	}

}
