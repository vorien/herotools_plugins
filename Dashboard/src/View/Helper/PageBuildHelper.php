<?php

namespace Vorien\Dashboard\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * CakePHP PageBuild
 * @author Michael
 */
class PageBuildHelper extends Helper {


    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

	public function openRow($class = null, $id = null) {
		$classout = "";
		$idout = "";

		if ($class) {
			$classout = " " . $class;
		}

		if ($id) {
			$idout = "id='" . $id . "' ";
		}

		return "<div " . $idout . "class='row" . $classout . "'>";
	}

	public function closeRow() {
		return "</div>";
	}

	public function openDiv($class = null, $id = null, $data = null) {
		$idout = "";
		$classout = "";
		$dataout = "";

		if ($id) {
			$idout = " id='" . $id . "'";
		}
		if ($class) {
			$classout = " class='" . $class . "'";
		}
		if ($data) {
			foreach ($data as $key => $value) {
				$dataout .= " data-" . $key . "='" . $value . "'";
			}
		}

		$output = "<div" . $idout . $classout . $dataout . ">";
		return $output;
	}

	public function closeDiv() {
		return "</div>";
	}

	public function makeDiv($content, $class = null, $id = null, $data = null) {
		$output = $this->openDiv($class, $id, $data);
		$output .= $content;
		$output .= $this->closeDiv();
		return $output;
	}

	public function makeDropDivVertical($hand, $type) {
		return $this->makeDiv("", "cl-drop-vertical border-" . $type, $hand . "-" . $type, array("hand" => $hand, "type" => $type));
	}

	public function makeDropDivHorizontal($hand, $type) {
		return $this->makeDiv("", "cl-drop-horizontal border-" . $type, $hand . "-" . $type, array("hand" => $hand, "type" => $type));
	}

	public function makeTargetBoxDiv($hand, $height, $penalty, $target) {
		return $this->makeDiv($target, "vertalign" . $height . " targetlocation", preg_replace("/[^A-Za-z0-9]/", "", $target), array("hand" => $hand, "penalty" => $penalty, "target" => $target));
	}

	public function makeDropDivSlider($type) {
		echo $this->openDiv("col-xs-3 div-slider");
		echo $this->makeDiv(strtoupper($type), "slider-heading");
		echo $this->makeDiv("&nbsp", "$type-current slider-current");
//		echo $this->makeDiv("&nbsp", "$type-current-data");
		$output = $this->openDiv("cl-set-slider", $type, array("type" => $type));
		$output .= $this->makeDiv("", "slider", "slider-" . $type, array('type' => $type));
		$output .= $this->closeDiv();
		$output .= $this->closeDiv();
		return $output;
	}

	public function makeTargetDiv($location, $penalty, $roll = null) {
		return $this->makeDiv($location, "targetlocation", preg_replace("/[^A-Za-z0-9]/", "", $location), array("penalty" => $penalty, "target" => $location, "roll" => $roll));
	}

	public function openAccordion($hand) {
		$output = "<div id='accordion-" . $hand . "' class='accordion'>";
		return $output;
	}

	public function openAccordionSection($hand, $section, $text) {
		$output = "<div class='panel'>";
		$output = "<div class='accordion-group'>";
		$output .= "<div class='accordion-heading'>";
		$output .= "<h4>";
		$output .= "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion-" . $hand . "' href='#collapse-" . $section . "-" . $hand . "'>";
		$output .= $text;
		$output .= "</a>";
		$output .= "</h4>";
		$output .= "</div>";
		$output .= "<div id='collapse-" . $section . "-" . $hand . "' class='accordion-body collapse' data-section='" . $section . "' data-hand='" . $hand . "'>";
		$output .= "<div class='accordion-inner'>";
//	$output .= "<p>";
		return $output;
	}

	public function closeAccordionSection() {
//	$output = "</p>";
		$output = "</div>";
		$output .= "</div>";
		$output .= "</div>";
//		$output .= "</div>";
		return $output;
	}
          
	public function closeAccordion() {
		$output = "</div>";
		return $output;
	}

	public function openUL($class = null, $id = null, $role = null) {
		$idout = "";
		$classout = "";
		$roleout = "";

		if ($id) {
			$idout = " id='" . $id . "'";
		}
		if ($class) {
			$classout = " class='" . $class . "'";
		}
		if ($role) {
			$roleout = " role='" . $role . "'";
		}

		$output = "<ul" . $idout . $classout . $roleout . ">";
		return $output;
	}

	public function closeUL() {
		return "</ul>";
	}


	public function makeLI($content, $class = null, $id = null, $data = null) {
		$output = $this->openLI($class, $id, $data);
		$output .= $content;
		$output .= $this->closeLI();
		return $output;
	}

	public function openLI($class = null, $id = null, $data = null) {
		$idout = "";
		$classout = "";
		$dataout = "";

		if ($id) {
			$idout = " id='" . $id . "'";
		}
		if ($class) {
			$classout = " class='" . $class . "'";
		}
		if ($data) {
			foreach ($data as $key => $value) {
				$dataout .= " data-" . $key . "='" . $value . "'";
			}
		}

		$output = "<li" . $idout . $classout . $dataout . ">";
		return $output;
	}

	public function closeLI() {
		return "</li>";
	}

	public function openButtonGroup($class = null, $id = null, $role = null) {
		$idout = ($id ? " id='" . $id . "'" : "");
		$classout = " class='btn-group" . ($class ? " " . $class : "")  . "'";
		$roleout = " role='group" . ($role ? " " . $role : "")  . "'";

		$output = "<div" . $idout . $classout . $roleout . ">";
		return $output;
	}

	public function closeButtonGroup() {
		return "</div>";
	}

	public function makeButton($content, $markup = null, $class=null, $id = null, $data = null) {
		$output = $this->openButton($markup, $class, $id, $data);
		$output .= $content;
		$output .= $this->closeButton();
		return $output;
	}

	public function openButton($markup = null, $class = null, $id = null, $data = null) {
		$idout = ($id ? " id='" . $id . "'" : "");
		$classout = " class='btn btn-" . ($markup ? $markup : "default") . ($class ? " " . $class : "")  . "'";
		$dataout = "";

		if ($data) {
			foreach ($data as $key => $value) {
				$dataout .= " data-" . $key . "='" . $value . "'";
			}
		}

		$output = "<button type='button'" . $idout . $classout . $dataout . ">";
		return $output;
	}

	public function closeButton() {
		return "</button>";
	}

		
		
		
//	public function openAccordionSection_old($hand, $section, $text) {
//		$output = "<div class='panel panel-default accordionpanel no-border'>";
//		$output .= "<div class='panel-heading no-border'>";
//		$output .= "<h4 class='panel-title'>";
//		$output .= "<a data-toggle='collapse' data-parent='#accordion' href='#collapse-" . $section . "-" . $hand . "'>" . $text . "</a>";
//		$output .= "</h4>";
//		$output .= "</div>";
//		$output .= "<div id='collapse-" . $section . "-" . $hand . "' class='panel-collapse collapse '>";
//		$output .= "<div class='panel-body no-border'>";
////	$output .= "<p>";
//		return $output;
//	}
//
//	public function closeAccordionSection_old() {
////	$output = "</p>";
//		$output = "</div>";
//		$output .= "</div>";
//		$output .= "</div>";
//		return $output;
//	}
//
//	public function openAccordion_old() {
//		$output = "<div class='accordion'>";
//		$output .= "    <div class='panel-group' id='accordion'>";
//		return $output;
//	}
//
//	public function closeAccordion_old() {
//		$output = "</div>";
//		$output .= "</div>";
//		return $output;
//	}

}
