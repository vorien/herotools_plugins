<?php
namespace Vorien\Dashboard\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * DisplayFunctions component
 */
class DisplayFunctionsComponent extends Component {

	public function showArrayAsTable($array, $column = null) {
		if (!empty($array)) {
			if (!empty($column)) {
				usort($array, buildSorter($column));
			}
			$this->echoline("<br><table border=1>");
			foreach ($array as $array_key => $array_value) {
				$this->echoline("<tr>");
				foreach ($array_value as $show) {
					$this->echoline("<td>" . $show . "</td>");
				}
				$this->echoline("</tr>");
			}
			$this->echoline("</table><br>");
		}
	}

	public function echo1DArrayAsTable($array, $headersonly = false) {
		if (!empty($array)) {
			echo("<br><table border=1>");
			echo("<tr>");
			foreach ($array as $array_key => $array_value) {
				if ($headersonly) {
					echo("<th>$array_key</th>");
				} else {
					echo("<td>" . $array_value . "</td>");
				}
			}
			echo("</tr>");
			echo("</table><br>");
		}
	}

	public function echo2DArrayAsTable($array, $column = null) {
		if (!empty($array)) {
			if (!empty($column)) {
				usort($array, buildSorter($column));
			}
			echo("<br><table border=1>");

			echo("<tr>");
			foreach (array_keys($array[0]) as $heading) {
				echo("<th>$heading</th>");
			}
			echo("</tr>");

			foreach ($array as $array_key => $array_value) {
				echo("<tr>");
				foreach ($array_value as $show) {
					echo("<td>" . $show . "</td>");
				}
				echo("</tr>");
			}
			echo("</table><br>");
		}
	}

	function echoline($string) {
		echo($string . "<br>\n");
	}

	function multidimensionalArrayToTable($array, $recursive = false, $border = 1, $blank = '&nbsp;') {
		if (empty($array) || !is_array($array)) {
			return false;
		}
		if (!isset($array[0]) || !is_array($array[0])) {
			$array = array($array);
		}

		$table = "<table border=$border>\n";

		$table .= "<tr>";
		foreach (array_keys($array[0]) as $heading) {
			$table .= '<th>' . $heading . '</th>';
		}
		$table .= "</tr>\n";

		foreach ($array as $row) {
			$table .= "<tr>";
			foreach ($row as $cell) {
				$table .= '<td>';
				if (is_object($cell)) {
					$cell = (array) $cell;
				}
				if ($recursive === true && is_array($cell) && !empty($cell)) {
					$table .= "\n" . $this->multidimensionalArrayToTable($cell, true) . "\n";
				} else {
					$table .= (strlen($cell) > 0) ? htmlspecialchars((string) $cell) : $blank;
				}
				$table .= '</td>';
			}
			$table .= "</tr>\n";
		}
		$table .= '</table>';
		return $table;
	}

		public function removeByKey(&$array, $keys) {
		if (is_array($array)) {
			foreach ($array as $key => &$value) {
				if (is_array($value)) {
					$this->removeByKey($value, $keys);
				} else {
					if (in_array($key, $keys)) {
						unset($array[$key]);
					}
				}
			}
		}
	}

}
