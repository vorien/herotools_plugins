<?php
//debug($maneuverlist);
if ($maneuverlist) {
	echo $this->HCPageBuild->openRow();
	echo $this->HCPageBuild->makeDiv("<b>Name</b>", "col-xs-4");
	echo $this->HCPageBuild->makeDiv("<b>Phase</b>", "col-xs-2");
	echo $this->HCPageBuild->makeDiv("<b>OCV</b>", "col-xs-3");
	echo $this->HCPageBuild->makeDiv("<b>DCV</b>", "col-xs-2");
	echo $this->HCPageBuild->makeDiv("<b>Effect</b>", "col-xs-10");
	echo $this->HCPageBuild->closeRow();

	foreach ($maneuverlist as $maneuver) {
		echo $this->HCPageBuild->openRow();
		echo $this->HCPageBuild->makeDiv($maneuver['maneuver'], "col-xs-4 maneuver-select", preg_replace("/[^A-Za-z0-9]/", "", $maneuver['maneuver']), $maneuver);
		echo $this->HCPageBuild->makeDiv($this->HCManeuverDisplay->getPhaseDisplay($maneuver['phase']), "col-xs-2");
		echo $this->HCPageBuild->makeDiv($this->HCManeuverDisplay->getOCVDisplay($maneuver['ocv_action'], $maneuver['ocv_amt']), "col-xs-3");
		echo $this->HCPageBuild->makeDiv($this->HCManeuverDisplay->getDCVDisplay($maneuver['dcv_action'], $maneuver['dcv_amt']), "col-xs-2");
		echo $this->HCPageBuild->makeDiv($maneuver['notes'], "col-xs-10");
		echo $this->HCPageBuild->closeRow();
	}
}
?>

