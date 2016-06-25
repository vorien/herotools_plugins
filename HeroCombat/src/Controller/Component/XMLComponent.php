<?php

namespace Vorien\HeroCombat\Controller\Component;

use Cake\Controller\Component;


/**
 * CakePHP HCXMLComponent
 * @author Michael
 */
class HCXMLComponent extends Component {

	public $components = array();

	function display_xml_error($error, $xml) {
		$return = $xml[$error->line - 1] . "\n";
		$return .= str_repeat('-', $error->column) . "^\n";

		switch ($error->level) {
			case LIBXML_ERR_WARNING:
				$return .= "Warning $error->code: ";
				break;
			case LIBXML_ERR_ERROR:
				$return .= "Error $error->code: ";
				break;
			case LIBXML_ERR_FATAL:
				$return .= "Fatal Error $error->code: ";
				break;
		}

		$return .= trim($error->message) .
				"\n  Line: $error->line" .
				"\n  Column: $error->column";

		if ($error->file) {
			$return .= "\n  File: $error->file";
		}

		return "$return\n\n--------------------------------------------\n\n";
	}

	function MergeXMLConfig($Old_XML_File, $New_XML_File, $BaseFolder) {
		$i = 0;

		/* XML File Paths */
		$Old_XML = $BaseFolder . $Old_XML_File; /* Path to Old XML File. Values will be read from this file. */
		$New_XML = $BaseFolder . $New_XML_File; /* Path to New XML File. */
		$Tmp_XML = "$Old_XML.tmp";
		$Merged_XML = $BaseFolder . "Merged_XML_File.xml"; /* Path to generated new XML File. */
		$Schema_XSD = ""; /* Path to Schema XSD File. */

		$Same_Field_List = array(); /* List of Parent/Child field */

		/* Simple XML Elements */
		$Old_XML_SXE = new SimpleXMLElement($Old_XML, null, true);
		$New_XML_SXE = new SimpleXMLElement($New_XML, null, true);

		/* Update XML File */
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($this->MergeXML($New_XML_SXE, $Old_XML_SXE, $i));
		$dom->save($Tmp_XML);

		if ($Schema_XSD != "") {
			if (SchemaValidate($Tmp_XML, $Schema_XSD)) {
				copy($Tmp_XML, $Merged_XML) or exit("ERROR: Failed to rename the generated new XML file.\n");
				unlink($Tmp_XML);
				return 0;
			} else {
				exit("ERROR: The generated new XML file failed the schema validation check.\n");
			}
		} else {
			copy($Tmp_XML, $Merged_XML) or exit("ERROR: Failed to rename the generated new XML file.\n");
			unlink($Tmp_XML);
			return 0;
		}
	}

	/* Function to vaildate schema XSD of a XML file */

	function SchemaValidate($xml_file, $xsd_file) {
		$xml = new DOMDocument();
		$xml->load($xml_file);

		if (!$xml->schemaValidate($xsd_file)) {
			return 0;
		} else {
			return 1;
		}
	}

	/* Function to constructively merge new XML file with values from old XML file */

	function MergeXML(SimpleXMLElement $New_xml, SimpleXMLElement $Old_xml, &$i) {
		global $Same_Field_List;
		if (count($Old_xml->children()) < 1) {
			//echo " DEBUG: $i : Value of " . $New_xml->getName() . ": $New_xml && " . $Old_xml->getName() .": $Old_xml <br>\n";
			if ($New_xml != "" && $New_xml != $Old_xml) {
				//echo "DEBUG: Updating " . $Old_xml->getName() . " with $New_xml <br>\n";
				$Old_xml = $New_xml;
			}
			$child_att = "";
			foreach ($Old_xml->attributes() as $a => $b) {
				$child_att .= " " . $a . '="' . $b . '"';
			}
			return "<" . $Old_xml->getName() . $child_att . ">" . $Old_xml . "</" . $Old_xml->getName() . ">\n";
		}

		$parnt_att = "";
		foreach ($Old_xml->attributes() as $a => $b) {
			$parnt_att .= " " . $a . '="' . $b . '"';
		}
		$ret = "<" . $Old_xml->getName() . $parnt_att . ">\n";
		$parent_name = $Old_xml->getName();
		foreach ($Old_xml->children() as $key => $child) {
			/* echo "DEBUG: Parent is : $parent_name && Key is : $key && Child is : $child <br>\n";
			  echo "DEBUG: New [$i] Parent is : ".$New_xml[0]->getName()." && Key is : ".$New_xml[0]->$key->getName()." && Child is : ".$New_xml[0]->$key." <br>\n";
			  if ($New_xml->$key->getName() != $key) {
			  echo "DEBUG: New Field Found !!! <br>\n";
			  continue;
			  } */

			/* Check if there are any fields which have same Parent/Field Name? If they have same name then 
			  they needs to be updated in a different manner. */
			if (count($Same_Field_List) > 0) {
				for ($m = 0; $m < count($Same_Field_List); $m++) {
					if ($key == $Same_Field_List[$m]) {
						//echo "DEBUG: New [$i] Parent is : ".$New_xml->getName()." && Key is : ".$New_xml->$key->getName()." && Child is : ".$New_xml->{$Same_Field_List[$m]}[$i]." <br>\n";
						$ret .= $this->MergeXML($child, $New_xml->{$Same_Field_List[$m]}[$i], $i);
						if ($m == (count($Same_Field_List) - 1))
							$i++;
						$is_same = "yes";
						break;
					} else {
						$is_same = "no";
					}
				}
			} else {
				$is_same = "no";
			}

			/* Check if a field is available in Old XML file. If that field is
			 * not available then there is no need to update new field values with
			 * old ones and so we will use new fields and its value and skip old
			 * xml file for that field. */
			if ($is_same == "no") {
				if ($New_xml->$key != "") {
					$ret .= $this->MergeXML($child, $New_xml->$key, $i);
				} else {
					$ret .= $this->ListXML($child);
				}
			}
		}

		$ret .= "</" . $Old_xml->getName() . ">\n";
		return $ret;
	}

	/* A recursive function to list XML file values */

	function ListXML(SimpleXMLElement $Old_xml) {
		if (count($Old_xml->children()) < 1) {
			$child_att = "";
			foreach ($Old_xml->attributes() as $a => $b) {
				$child_att .= " " . $a . '="' . $b . '"';
			}
			return "<" . $Old_xml->getName() . $child_att . ">" . $Old_xml . "</" . $Old_xml->getName() . ">\n";
		}

		$parnt_att = "";
		foreach ($Old_xml->attributes() as $a => $b) {
			$parnt_att .= " " . $a . '="' . $b . '"';
		}
		$ret = "<" . $Old_xml->getName() . $parnt_att . ">\n";
		$parent_name = $Old_xml->getName();
		foreach ($Old_xml->children() as $key => $child) {
			$ret .= $this->ListXML($child);
		}

		$ret .= "</" . $Old_xml->getName() . ">\n";
		return $ret;
	}

}
