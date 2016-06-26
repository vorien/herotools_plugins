<?php
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
?>

