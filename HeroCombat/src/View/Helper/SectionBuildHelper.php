<?php

namespace Vorien\HeroCombat\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * CakePHP SectionBuildHelper
 * @author Michael
 */
class SectionBuildHelper extends Helper {

	public $helpers = ['Vorien/Dashboard.PageBuild', 'Html', 'Vorien/HeroCombat.ManeuverDisplay'];

	/**
	 * Default configuration.
	 *
	 * @var array
	 */
	protected $_defaultConfig = [];
	private $weapons;
	private $characterinfo;
	private $locationinfo;
	private $targetinfo;
	private $maneuvers_standard;
	private $maneuvers_optional;
	private $armorlocationinfo;

//	public $helpers = array('Vorien/HeroCombat.ManeuverDisplay', 'Vorien/HeroCombat.PageBuild', 'Html');

	public function initialize(array $_defaultConfig) {
		$this->weapons = $this->_View->viewVars['weapons'];
		$this->characterinfo = $this->_View->viewVars['characterinfo'];
		$this->locationinfo = $this->_View->viewVars['locationinfo'];
		$this->targetinfo = $this->_View->viewVars['targetinfo'];
		$this->maneuvers_standard = $this->_View->viewVars['maneuvers_standard'];
		$this->maneuvers_optional = $this->_View->viewVars['maneuvers_optional'];
		$this->armorlocationinfo = $this->_View->viewVars['armorlocationinfo'];
	}

	public function buildTopSection() {
		echo $this->PageBuild->makeDiv("", "character-info");
		echo $this->PageBuild->openRow("top-section");

		echo $this->PageBuild->makeDiv("&nbsp;", "col-xs-1");

		echo $this->PageBuild->openDiv("col-xs-5");
		$this->showWeaponList('attack');
		$this->showWeaponList('defense');
		$this->showUsageDetails();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->makeDiv(null, "col-xs-1");

		echo $this->PageBuild->openDiv("col-xs-4");
		$this->showCalculatedValues();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->makeDiv(null, "col-xs-1");

		echo $this->PageBuild->openDiv("col-xs-5");
		$this->showDamageStatusDisplay();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->openDiv("col-xs-7");
		$this->showDamageStatusCalculations();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->closeRow();

		$this->buildTabs();
	}

	public function showCalculatedValues() {
		echo $this->PageBuild->openDiv(null, "level-calculations");
		echo $this->PageBuild->makeDiv("<h3 class='text-center'>Calculated<br />Values</h3>");
		echo $this->PageBuild->openDiv(null, "level-calculations-content");
		$this->buildCalculationDisplay("ocv");
		$this->buildCalculationDisplay("dcv");
		$this->buildCalculationDisplay("dmg");
		$this->buildCalculationDisplay("tgt");
		$this->buildCalculationDisplay("str");
		$this->buildCalculationDisplay("end");
		$this->buildCalculationDisplay("man");
		echo $this->PageBuild->makeDiv("<input type='hidden' id='tgt-penalty' value='0'>");
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
	}

	public function showUsageDetails() {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-24");
		echo $this->PageBuild->makeDiv("&nbsp;", "clearfix");
		echo $this->PageBuild->makeDiv("Strength: ", "pull-left");
		echo $this->PageBuild->makeDiv("", "pull-left", "str-used-wrapper");
		echo $this->PageBuild->makeDiv("&nbsp;", "clearfix");
		echo $this->PageBuild->makeDiv("&nbsp;");
		echo $this->PageBuild->makeDiv("Distance (m):");
		echo $this->PageBuild->openDiv();
		echo "[max <span id='rng-max'></span>]: <input type='text' id='rng-distance' class='rng-distance-input' size='3'>";
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv(null, 'two-hands-wrapper');
		echo "  Two Hands <input type='checkbox' id='two-hands'>";
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->makeDiv("&nbsp;", "clearfix");
		echo $this->PageBuild->openButtonGroup("col-xs-24");
		echo $this->PageBuild->makeButton("Execute", "success", "btn-xs", "dcalc-execute");
		echo $this->PageBuild->closeButtonGroup();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();
	}

	public function showWeaponList($type) {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-24");
		echo $this->PageBuild->openDiv(null, "weapon-choice-" . $type);
		echo $this->PageBuild->makeDiv("<b>" . ucfirst($type) . "</b>");
		echo "<select id='weapon-select-$type'>";
		foreach ($this->weapons as $weapon_id => $weapon) {
			echo "<option value='" . $weapon_id . "'" . ($weapon['weapon_id'] == 90 ? " SELECTED" : "") . ">" . $weapon['name'] . "</option>";
		}
		echo "</select>";
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();
	}

	public function buildSidebar() {
//		echo $this->PageBuild->openDiv("col-xs-3", "sidebar");
//		echo $this->PageBuild->openDiv("actions");
//		echo $this->PageBuild->openUL("list-group");
//		echo $this->PageBuild->makeLI($this->Html->link(__('Dashboard'), array('controller' => 'dashboard')), "list-group-item");
//		echo $this->PageBuild->makeLI("&nbsp;");
//		echo $this->PageBuild->makeLI($this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')), "list-group-item");
//		echo $this->PageBuild->closeUL();
//		echo $this->PageBuild->closeDiv();
//		echo $this->PageBuild->closeDiv();
	}

	public function showDamageStatusDisplay() {
		$statcol1 = 10;
		$statcol22 = 8;
		$statcol32 = 7;
		$statcol33 = 7;
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("<h4>Character Status</h4>", "col-xs-24");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("PD", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['n_pd'] . " / r" . ($this->characterinfo['r_pd'] ? : 0 ), "col-xs-" . $statcol22);
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("ED", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['n_ed'] . " / r" . ($this->characterinfo['r_ed'] ? : 0), "col-xs-" . $statcol22);
		echo $this->PageBuild->closeRow();
//		echo $this->PageBuild->openRow();
//		echo $this->PageBuild->makeDiv("Resistant PD", "col-xs-" . $statcol1);
//		echo $this->PageBuild->makeDiv($this->characterinfo['r_pd'], "col-xs-" . $statcol2);
//		echo $this->PageBuild->closeRow();
//		echo $this->PageBuild->openRow();
//		echo $this->PageBuild->makeDiv("Resistant PD", "col-xs-" . $statcol1);
//		echo $this->PageBuild->makeDiv($this->characterinfo['r_ed'], "col-xs-" . $statcol2);
//		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("Con", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['con'], "col-xs-" . $statcol22, "dcalc-con");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("Recovery", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['recovery'], "col-xs-" . $statcol22, "dcalc-recovery");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("Body", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['body'], "col-xs-" . $statcol32, "dcalc-bodystart");
		echo $this->PageBuild->makeDiv("( <span id='dcalc-bodyremaining' class='dc-body-normal'>" . $this->characterinfo['body'] . "</span> )", "col-xs-" . $statcol33);
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("Stun", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['stun'], "col-xs-" . $statcol32, "dcalc-stunstart");
		echo $this->PageBuild->makeDiv("( <span id='dcalc-stunremaining' class='dc-stun-normal'>" . $this->characterinfo['stun'] . "</span> )", "col-xs-" . $statcol33);
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("Endurance", "col-xs-" . $statcol1);
		echo $this->PageBuild->makeDiv($this->characterinfo['endurance'], "col-xs-" . $statcol32, "dcalc-endstart");
		echo $this->PageBuild->makeDiv("( <span id='dcalc-endremaining' class='dc-end-normal'>" . $this->characterinfo['endurance'] . "</span> )", "col-xs-" . $statcol33);
		echo $this->PageBuild->closeRow();
	}

	public function showDamageStatusCalculations() {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("<h4>Damage Calculator</h4>", "col-xs-24");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->makeDiv("Location:", "col-xs-8");
		echo $this->PageBuild->openDiv("col-xs-12");
		echo "<select id='dcalc-location'>";
		foreach ($this->locationinfo as $key => $location) {
			echo "<option value=" . $location['roll'] . ">" . $location['locationdata'] . "</option>";
		}
		echo "</select>";
		echo $this->PageBuild->closeDiv();
//		echo $this->PageBuild->makeDiv("<input id='dcalc-location' type='number'>", "col-xs-4");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->makeDiv("Body:", "col-xs-8");
		echo $this->PageBuild->makeDiv("<input id='dcalc-body' type='number'>", "col-xs-6");
		echo $this->PageBuild->makeDiv(null, "col-xs-4");
		echo $this->PageBuild->makeDiv(null, "col-xs-4", "dcalc-bodytaken");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->makeDiv("Stun:", "col-xs-8");
		echo $this->PageBuild->makeDiv("<input id='dcalc-stun' type='number'>", "col-xs-6");
		echo $this->PageBuild->makeDiv(null, "col-xs-4");
		echo $this->PageBuild->makeDiv(null, "col-xs-4", "dcalc-stuntaken");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->makeDiv("Type", "col-xs-8");
		echo $this->PageBuild->makeDiv("<select id='dcalc-type'><option selected value='Physical'>Physical</option><option value='Energy'>Energy</option></select>", "col-xs-8");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->makeDiv("Effect", "col-xs-8");
		echo $this->PageBuild->makeDiv("<select id='dcalc-effect'><option selected value='None'>None</option><option value='AP'>AP</option><option value='AP2'>AP2</option><option value='NND'>NND</option></select>", "col-xs-8");
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow('dc-row');
		echo $this->PageBuild->openButtonGroup("col-xs-24");
		echo $this->PageBuild->makeButton("Calculate", "success", "btn-xs", "dcalc-calc");
		echo $this->PageBuild->makeButton("Apply", "danger", "btn-xs", "dcalc-apply");
		echo $this->PageBuild->makeButton("Recover", "info", "btn-xs", "dcalc-recover");
		echo $this->PageBuild->makeButton("Heal", "warning", "btn-xs", "dcalc-heal");
		echo $this->PageBuild->makeButton("Clear", "active", "btn-xs", "dcalc-clear");
		echo $this->PageBuild->makeButton("Reset", "active", "btn-xs", "dcalc-reset");
		echo $this->PageBuild->closeButtonGroup();
		echo $this->PageBuild->closeRow();
	}

	public function buildCalculationDisplay($type) {
		echo $this->PageBuild->openRow(null, "calcs-$type");
		echo $this->PageBuild->makeDiv(strtoupper($type), "col-xs-8");
		if ($type == "ocv") {
			echo $this->PageBuild->makeDiv(null, "col-xs-4 $type-current");
			echo $this->PageBuild->makeDiv(null, "col-xs-12 $type-roll");
		} else {
			echo $this->PageBuild->makeDiv(null, "col-xs-16 $type-current");
		}
		echo $this->PageBuild->closeRow();
	}

	public function buildTabs() {
		echo $this->PageBuild->openRow("clear");
		echo $this->PageBuild->openDiv("main-tab-wrapper");
		echo $this->PageBuild->openUL('nav nav-tabs', 'maintabs', 'tablist');
		echo $this->PageBuild->makeLI('<a href="#weapons" role="tab" data-toggle="tab" data-hand="main">Weapons</a>', 'active', 'tab-weapons');
		echo $this->PageBuild->makeLI('<a href="#target" role="tab" data-toggle="tab" data-hand="off">Target</a>', null, 'tab-target');
		echo $this->PageBuild->makeLI('<a href="#maneuvers" role="tab" data-toggle="tab" data-hand="">Maneuvers</a>', null, 'tab-maneuvers');
		echo $this->PageBuild->makeLI('<a href="#armor" role="tab" data-toggle="tab" data-hand="">Armor</a>', null, 'tab-armor');
		echo $this->PageBuild->closeUL();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();

		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv("&nbsp", "col-xs-24");
		echo $this->PageBuild->closeRow();

		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-24");
		echo $this->PageBuild->openDiv("tab-content");
		echo $this->PageBuild->openDiv("tab-pane active", "weapons");
		$this->buildWeapons();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv("tab-pane", "target");
		$this->buildTargets();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv("tab-pane", "maneuvers");
		$this->buildManeuverChart();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv("tab-pane", "armor");
		$this->buildArmorSection();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();
	}

	public function buildWeapons() {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDropDivSlider("ocv");
		echo $this->PageBuild->makeDropDivSlider("dcv");
		echo $this->PageBuild->makeDropDivSlider("dmg");
		echo $this->PageBuild->makeDropDivSlider("rng");
		echo $this->PageBuild->makeDropDivSlider("tgt");
		echo $this->PageBuild->makeDropDivSlider("def");
		echo $this->PageBuild->closeRow();
	}

	public function showRanges() {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv('Penalty', "col-xs-6");
		echo $this->PageBuild->makeDiv('Location', "col-xs-12");
		echo $this->PageBuild->makeDiv('Roll', "col-xs-6");
		echo $this->PageBuild->closeRow();
		foreach ($this->targetinfo['shot'] as $target) {
			echo $this->PageBuild->openRow();
			echo $this->PageBuild->makeDiv($target['penalty'], "col-xs-6");
			echo $this->PageBuild->makeDiv($this->PageBuild->makeTargetDiv($target['location'], $target['penalty'], $target['roll']), "col-xs-12");
			echo $this->PageBuild->makeDiv($target['roll'], "col-xs-6");
			echo $this->PageBuild->closeRow();
		}
	}

	public function showTargets($type) {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv('Penalty', "col-xs-4");
		echo $this->PageBuild->makeDiv('Location', "col-xs-8");
		echo $this->PageBuild->makeDiv('StunX', "col-xs-4");
		echo $this->PageBuild->makeDiv('BodyX', "col-xs-4");
		echo $this->PageBuild->makeDiv('nStun', "col-xs-4");
		echo $this->PageBuild->closeRow();
		foreach ($this->targetinfo[$type] as $target) {
			echo $this->PageBuild->openRow();
			echo $this->PageBuild->makeDiv($target['penalty'], "col-xs-4");
			echo $this->PageBuild->makeDiv($this->PageBuild->makeTargetDiv($target['location'], $target['penalty'], $target['roll']), "col-xs-8");
			echo $this->PageBuild->makeDiv($target['stunx'], "col-xs-4");
			echo $this->PageBuild->makeDiv($target['bodyx'], "col-xs-4");
			echo $this->PageBuild->makeDiv($target['nstun'], "col-xs-4");
			echo $this->PageBuild->closeRow();
		}
	}

	public function buildTargets() {
		echo $this->PageBuild->openRow();

		echo $this->PageBuild->openDiv("col-xs-9");
		$this->showRanges();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->makeDiv('&nbsp;', "col-xs-1");

		echo $this->PageBuild->openDiv("col-xs-14");
		echo $this->PageBuild->openRow();
		$this->showTargets('general');
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->openRow();
		$this->showTargets('special');
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->closeRow();
	}

	public function buildManeuverChart() {
		echo $this->PageBuild->openRow();

		echo $this->PageBuild->openDiv("col-xs-5");
		
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-24");
		echo $this->PageBuild->openUL($class = 'nav nav-tabs nav-stacked', $id = 'maneuvertabs', $role = null);
		echo $this->PageBuild->makeLI("<a href='#maneuvers-standard' role='tab' data-toggle='tab'>Standard</a>", $class = 'active');
		echo $this->PageBuild->makeLI("<a href='#maneuvers-optional' role='tab' data-toggle='tab'>Optional</a>");
		echo $this->PageBuild->makeLI("<a href='#maneuvers-martial' role='tab' data-toggle='tab'>Martial</a>");
		echo $this->PageBuild->closeUL();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();

		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-24");
		echo $this->PageBuild->makeDiv("Action", null, "var-action");
		echo $this->PageBuild->makeDiv("<input type='text' size='4' id='input-action'>");
		echo $this->PageBuild->makeDiv("&nbsp;", null, "var-action");
		echo $this->PageBuild->openDiv();
		echo "<input id='input-action' type='text'>";
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->makeDiv("&nbsp;", "col-xs-1");

		echo $this->PageBuild->openDiv("col-xs-18");
		echo $this->PageBuild->openDiv("tab-content");
		echo $this->PageBuild->openDiv("tab-pane active", "maneuvers-standard");
		echo $this->buildManeuverSection($this->maneuvers_standard);
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv("tab-pane", "maneuvers-optional");
		echo $this->buildManeuverSection($this->maneuvers_optional);
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->openDiv("tab-pane", "maneuvers-martial");
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeDiv();
		
		echo $this->PageBuild->closeRow();
	}

	public function buildArmorSection() {
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->openDiv("col-xs-18");
		echo $this->PageBuild->openRow();
		echo $this->PageBuild->makeDiv('Location', "col-xs-5");
		echo $this->PageBuild->makeDiv('PD', "col-xs-3");
		echo $this->PageBuild->makeDiv('ED', "col-xs-3");
		echo $this->PageBuild->makeDiv('Armor', "col-xs-5");
		echo $this->PageBuild->makeDiv('Material', "col-xs-5");
		echo $this->PageBuild->closeRow();
		foreach ($this->armorlocationinfo as $location) {
			echo $this->PageBuild->openRow();
			echo $this->PageBuild->makeDiv(implode(" - ", $location['location']), "col-xs-5");
			echo $this->PageBuild->makeDiv($location['r_pd'], "col-xs-3");
			echo $this->PageBuild->makeDiv($location['r_ed'], "col-xs-3");
			echo $this->PageBuild->makeDiv($location['armor']['armor'], "col-xs-5");
			echo $this->PageBuild->makeDiv(implode(" - ", $location['material']), "col-xs-8");
			echo $this->PageBuild->closeRow();
		}
		echo $this->PageBuild->closeDiv();

		echo $this->PageBuild->openDiv("col-xs-6");

		echo $this->PageBuild->closeDiv();
		echo $this->PageBuild->closeRow();
	}

	function buildManeuverSection($maneuverlist) {
		if ($maneuverlist) {
			echo $this->PageBuild->openRow();
			echo $this->PageBuild->makeDiv("<b>Name</b>", "col-xs-4");
			echo $this->PageBuild->makeDiv("<b>Phase</b>", "col-xs-2");
			echo $this->PageBuild->makeDiv("<b>OCV</b>", "col-xs-3");
			echo $this->PageBuild->makeDiv("<b>DCV</b>", "col-xs-2");
			echo $this->PageBuild->makeDiv("<b>Effect</b>", "col-xs-10");
			echo $this->PageBuild->closeRow();

			foreach ($maneuverlist as $maneuver) {
				echo $this->PageBuild->openRow();
				echo $this->PageBuild->makeDiv($maneuver['maneuver'], "col-xs-4 maneuver-select", preg_replace("/[^A-Za-z0-9]/", "", $maneuver['maneuver']), $maneuver);
				echo $this->PageBuild->makeDiv($this->ManeuverDisplay->getPhaseDisplay($maneuver['phase']), "col-xs-2");
				echo $this->PageBuild->makeDiv($this->ManeuverDisplay->getOCVDisplay($maneuver['ocv_action'], $maneuver['ocv_amt']), "col-xs-3");
				echo $this->PageBuild->makeDiv($this->ManeuverDisplay->getDCVDisplay($maneuver['dcv_action'], $maneuver['dcv_amt']), "col-xs-2");
				echo $this->PageBuild->makeDiv($maneuver['notes'], "col-xs-10");
				echo $this->PageBuild->closeRow();
			}
		}
	}

}
