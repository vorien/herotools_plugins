<?php

namespace Vorien\Dashboard\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * CakePHP FormHelper
 * @author Michael
 */
class FormHelper extends Helper {


    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

//	public $helpers = array("Form");

	public function inputRow($field, $label = null) {
		$model = & ClassRegistry::getObject($this->Form->model());
		$schema = $model->schema();
//		echo $field . " type: " . $schema[$field]["type"];

		$display_array = array(
			"class" => "form-control-row",
			'before' => "<div class='row form-row'><div class='col-xs-8 form-row-label'>",
			'between' => "</div><div class='col-xs-12 form-row-input'>",
			'after' => "</div></div>"
		);
		if ($label) {
			$display_array["label"] = $label;
		}
		if ($schema[$field]["type"] == "boolean") {
//			echo("boolean");
			$display_array['format'] = array('before', 'label', 'between', 'input', 'after', 'error');
		}
		$output = "<div class='form-group-row'>\n";
		$output .= $this->Form->input($field, $display_array);
		$output .= "</div><!-- .form-group -->";
		return $output;
	}

}
