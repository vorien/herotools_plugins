<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/*
 * CakePHP ArchivedfunctionsComponent
 * @author Michael
*/ 
class ArchivedfunctionsComponent extends Component {

/* XML Functions



//	function append_simplexml(&$simplexml_to, &$simplexml_from) {
//		foreach ($simplexml_from->children() as $simplexml_child) {
//			$simplexml_temp = $simplexml_to->addChild($simplexml_child->getName(), (string) $simplexml_child);
//			foreach ($simplexml_child->attributes() as $attr_key => $attr_value) {
//				$simplexml_temp->addAttribute($attr_key, $attr_value);
//			}
//			append_simplexml($simplexml_temp, $simplexml_child);
//		}
//	}

	function moveMultiSkills(&$xml, $tag, $attributes) {
		$xpath = new \DOMXPath($xml);
		$skillsNode = $xml->getElementsByTagName('SKILLS')->item(0);
		$groupnodes = $xml->createElement($tag);
		$xpathquery = "//SKILL[@XMLID='$tag']";
		while (($nodelist = $xpath->query($xpathquery)) && $nodelist->length) {
			foreach ($nodelist as $skillNode) {
				$tagstring = '';
				foreach ($attributes as $attribute) {
					$tagstring .= $skillNode->getAttribute($attribute);
				}
				$newtag = preg_replace('/[\W_]+/', '', $tagstring);
				if (empty($newtag)) {
					var_dump($skillNode);
					die('attributes parameter produced an empty string');
				}
				$newnode = $this->getRenamedNode($skillNode, $newtag);
				$groupnodes->appendchild($newnode);
				$skillNode->parentNode->removeChild($skillNode);
			}
		}
		$skillsNode->appendChild($groupnodes);
	}

//	function processTags(&$xml, $taginfo) {
//		//['PERKS', 'PERK', 'XMLID', 'NAME'],
//		$parenttag = $taginfo[0];
//		$tag = $taginfo[1];
//		$attributes = $taginfo[2];
//		$xpath = new \DOMXPath($xml);
//		$parentnode = $xml->getElementsByTagName($parenttag)->item(0);
//		$nodepath = $parentnode->getNodePath();
//		$xpathquery = "$nodepath/$tag";
//		while (($nodelist = $xpath->query($xpathquery)) && $nodelist->length) {
//			$tagsout = $taginfo;
//			$tagsout[] = $nodelist->item(0)->getAttribute('XMLID');
//			$this->moveNodes($xml, $tagsout);
//		}
//	}

	function moveTags(&$xml, $taginfo) {
		//['PERKS', 'PERK', 'XMLID', 'NAME'],
		$parenttag = $taginfo[0];
		$oldtag = $taginfo[1];
		$group = $taginfo[2];
		$attribute = $taginfo[3];
		$xpath = new \DOMXPath($xml);
		$parentnode = $xml->getElementsByTagName($parenttag)->item(0);
		$nodepath = $parentnode->getNodePath();
		$xpathquery = "$nodepath/$oldtag";
//		debug($xpathquery);
		while (($nodelist = $xpath->query($xpathquery)) && $nodelist->length) {
			$grouptype = $nodelist[0]->getAttribute($group);
			$groupnodes = $xml->createElement($grouptype);
			$groupquery = "$nodepath/$oldtag" . "[@$group='$grouptype']";
//				debug($groupquery);
			while (($grouplist = $xpath->query($groupquery)) && $grouplist->length) {
				foreach ($grouplist as $oldnode) {
					$newtag = preg_replace('/[\W_]+/', '', $oldnode->getAttribute($attribute));
					if (empty($newtag)) {
						debug($taginfo);
						var_dump($oldnode);
						die('attributes parameter produced an empty string');
					}
					$newnode = $this->getRenamedNode($oldnode, $newtag);
					$groupnodes->appendchild($newnode);
					$oldnode->parentNode->removeChild($oldnode);
				}
			}
			$parentnode->appendChild($groupnodes);
		}
	}

	function moveNodes(&$xml, $taginfo) {
//		debug($taginfo);
		//['SKILLS', 'SKILL', 'ALIAS', 'INPUT', 'KNOWLEDGE_SKILL'],
		$parenttag = $taginfo[0];
		$oldtag = $taginfo[1];
		$group = $taginfo[2];
		$attribute = $taginfo[3];
		$xmlid = $taginfo[4];
		$xpath = new \DOMXPath($xml);
		$parentnode = $xml->getElementsByTagName($parenttag)->item(0);
		$nodepath = $parentnode->getNodePath();
		$xmlidnodes = $xml->createElement($xmlid);
		$xpathquery = "$nodepath/$oldtag" . "[@XMLID='$xmlid']";
//		debug($xpathquery);
		while (($nodelist = $xpath->query($xpathquery)) && $nodelist->length) {
//			foreach ($nodelist as $oldnode) {
			$oldnode = $nodelist[0];
			$grouptype = $oldnode->getAttribute($group);
			$groupnodes = $xml->createElement($grouptype);
			$groupquery = "$nodepath/$oldtag" . "[@XMLID='$xmlid' and @$group='$grouptype']";
//				debug($groupquery);
			while (($grouplist = $xpath->query($groupquery)) && $grouplist->length) {
				foreach ($grouplist as $oldGroup) {
					$newtag = preg_replace('/[\W_]+/', '', $oldGroup->getAttribute($attribute));
					if (empty($newtag)) {
						debug($taginfo);
						var_dump($oldGroup);
						die('attributes parameter produced an empty string');
					}
					$newnode = $this->getRenamedNode($oldGroup, $newtag);
					$groupnodes->appendchild($newnode);
					$oldGroup->parentNode->removeChild($oldGroup);
				}
			}
			$xmlidnodes->appendChild($groupnodes);
//			}
		}
		$parentnode->appendChild($xmlidnodes);
	}

	function countNodes($element, $depth = 0) {
		$nodes = [];
		$xmlids = [];
		foreach ($element->childNodes as $value) {
			if ($value->nodeType !== XML_TEXT_NODE) {
				if (array_key_exists($value->nodeName, $nodes)) {
					$nodes[$value->nodeName] += 1;
				} else {
					$nodes[$value->nodeName] = 1;
				}
//				if ($xmlid = $value->getAttribute('XMLID')) {
//					if (array_key_exists($xmlid, $xmlids)) {
//						$xmlids[$xmlid] += 1;
//					} else {
//						$xmlids[$xmlid] = 1;
//					}
//				}
				if ($value->childNodes->length > 0) {
//					echo str_repeat('&nbsp;', $depth * 3), $value->nodeName, '<br>', PHP_EOL;
					$this->countNodes($value, $depth + 1);
				} else {
					
				}
			}
		}
		if (!empty($nodes)) {
			foreach ($nodes as $nkey => $nvalue) {
				if ($nvalue > 1) {
					echo str_repeat('&nbsp;', ($depth - 1) * 3), 'duplicates - ', $nkey, ': ', $nvalue, '<br />', PHP_EOL;
				}
			}
		}
//		if (!empty($xmlids)) {
//			foreach ($xmlids as $nkey => $nvalue) {
//				if($nvalue > 1){
//				echo str_repeat('&nbsp;', ($depth - 1) * 3), 'xmlids - ', $nkey, ': ', $nvalue, '<br />', PHP_EOL;
//				}
//			}
//		}
	}

//	function wrapTags(&$xml, $nodeName, $wrapperName, $replacementName = null) {
//		$xpath = new \DOMXPath($xml);
//		$xpathquery = '//' . $nodeName;
//		$nodelist = $xpath->query($xpathquery);
//		for ($i = $nodelist->length - 1; $i > -1; $i--) {
//			$oldnode = $nodelist[$i];
////				echo $oldnode->getNodePath(), ': ', $oldnode->nodeName, ': ', $oldnode->getAttribute('XMLID'), '<br />', PHP_EOL;
////			foreach ($oldnode->attributes as $attribute) {
////				echo $attribute->name, ': ', $attribute->value, '<br>', PHP_EOL;
////			}
//			$newName = empty($replacementName) ? $oldnode->getAttribute('XMLID') : $replacementName;
////			if(!$newName){
////			echo $oldnode->getNodePath(), ': ', $oldnode->nodeName, ': <b>', $newName, '</b><br />', PHP_EOL;
////			}
//			$this->wrapNode($oldnode, $wrapperName, $newName);
//		}
//	}
//	function wrapNode($oldnode, $wrapperName, $newName) {
////		echo $oldnode->nodeName, ': ', $newName, '<br />', PHP_EOL;
//		$document = $oldnode->ownerDocument;
//		$wrapperNode = $document->createElement($wrapperName);
//		$renamedNode = $this->getRenamedNode($oldnode, $newName);
//		$oldnode->parentNode->appendChild($wrapperNode);
//		$wrapperNode->appendChild($renamedNode);
//		$oldnode->parentNode->removeChild($oldnode);
//	}
//	function displayNode($node) {
//		foreach ($node as $item) {
//			echo $item->nodeName;
//			if ($item->hasChildren()) {
//				echo('<br>');
//				$this->displayNode($item);
//			} else {
//				echo $item->nodeValue, '<br>';
//			}
//		}
//	}


	public function updateSkillNodes(&$xml) {
		$skillsNode = $xml->getElementsByTagName('SKILLS')->item(0);
		$i = $skillsNode->childNodes->length - 1;
		while ($i > -1) {
			$skillNode = $skillsNode->childNodes->item($i);
			if ($skillNode->nodeName == 'SKILL') {
				$newnode = $this->getRenamedNode($skillNode, $skillNode->getAttribute('XMLID'));
				$skillNode->parentNode->replaceChild($newnode, $skillNode);
			}
			$i--;
		}
	}

	function checkXMLID($array, $parentkey = null) {
		$outarray = [];
		foreach ($array as $key => $value) {
			if (!is_array($value)) {
				$outarray[$key] = $value;
			} else {
				if (is_numeric($key)) {
					if (array_key_exists('@XMLID', $value)) {
						$outarray[$value['@XMLID']] = $this->checkXMLID($value, $key);
						$outarray[$value['@XMLID']]['@TAG'] = $parentkey;
					}
				} else {
					$outarray[$key] = $this->checkXMLID($value, $key);
				}
			}
		}
		return $outarray;
	}

	function index($character_id = null, $print = false) {
		$xmlfiles = $this->getXMLFilesForCharacterID($character_id);

		$character_sxml = $xmlfiles['character_sxml'];
		$main_sxml = $xmlfiles['main_sxml'];
		$character_xml = $xmlfiles['character_xml']->ownerDocument;
		$main_xml = $xmlfiles['main_xml']->ownerDocument;
//exit;
		$this->moveEnhancers($character_xml);

//		debug(Xml::toArray($character_xml));
//		exit;

		$multiskills = [
			['SKILLS', 'SKILL', 'ALIAS', 'INPUT', 'KNOWLEDGE_SKILL'],
			['SKILLS', 'SKILL', 'ALIAS', 'INPUT', 'PROFESSIONAL_SKILL'],
			['SKILLS', 'SKILL', 'OPTION', 'NAME', 'SKILL_LEVELS'],
			['SKILLS', 'SKILL', 'OPTION', 'NAME', 'COMBAT_LEVELS'],
			['SKILLS', 'SKILL', 'OPTION', 'NAME', 'PENALTY_SKILL_LEVELS']
		];
		foreach ($multiskills as $replacetag) {
			$this->moveNodes($character_xml, $replacetag);
		}

		  $multitags = [
		  ['PERKS', 'PERK', 'XMLID', 'NAME'],
		  ['TALENTS', 'TALENT', 'XMLID', 'NAME'],
		  ['POWERS', 'POWER', 'XMLID', 'NAME'],
		  ['DISADVANTAGES', 'DISAD', 'XMLID', 'INPUT']
		  ];
		  foreach ($multitags as $replacetag) {
		  $this->moveTags($character_xml, $replacetag);
		  }

		  $templateNode = $character_xml->getElementsByTagName('TEMPLATE')->item(0);
		  $template_xml = $templateNode->cloneNode(true);
		  $templateNode->parentNode->removeChild($templateNode);
		  $rulesNode = $character_xml->getElementsByTagName('RULES')->item(0);
		  $rules_xml = $rulesNode->cloneNode(true);
		  $rulesNode->parentNode->removeChild($rulesNode);

		  //		foreach ($multitags as $replacetag) {
		  //			$this->moveTags($main_xml, $replacetag);
		  //		}

		$this->removeEmptyTags($character_xml);
		$this->removeEmptyTags($main_xml);

		$this->updateSkillNodes($character_xml);
//		$this->updateSkillNodes($template_xml);
		$this->updateSkillNodes($main_xml);

//		debug('character_array');
//		$character_array = Xml::toArray($character_xml);
		$character_array = $this->PStandardize->standardizeArray(Xml::toArray($character_xml));
//		debug('template_array');
//		$template_array = $this->PStandardize->standardizeArray(Xml::toArray($template_xml));
//		debug('rules_array');
//		$rules_array = $this->PStandardize->standardizeArray(Xml::toArray($rules_xml));
//		debug('main_array');
//		$main_array = Xml::toArray($main_xml);
		$main_array = $this->PStandardize->standardizeArray(Xml::toArray($main_xml));
//		$merged_array = array_replace_recursive($main_array, $template_array);

		$cbase = $character_array['CHARACTER'];
		$mbase = $main_array['TEMPLATE'];
		$subarray = ['SKILLS', 'SURVIVAL'];
//		$this->compareArrays($cbase, $mbase, $subarray);

		debug($this->getSubarray($mbase, $subarray));
		debug($this->getSubarray($cbase, $subarray));

		foreach ($mergedCharacter['CHARACTERISTICS'] as $key => $characteristic) {
		  $cdisplayarray = $this->PSkillDisplay->getCharacteristicDisplay($characteristic, $rules_clean['attributes'][$key . "_MAX"]);
		  $characteristics[$key] = $cdisplayarray;
		  }
	}

	function compareArrays($cbase, $mbase, $subarray, $depth = 0) {
		$spacer = str_repeat('&nbsp;', $depth * 3);
		if ($charskill = $this->getSubarray($cbase, $subarray)) {
			if ($mergedskill = $this->getSubarray($mbase, $subarray)) {
				foreach ($charskill as $key => $value) {
					switch ($key) {
						case 'PROFESSIONAL_SKILL':
						case 'KNOWLEDGE_SKILL':
						case 'SKILL_LEVELS':
						case 'PENALTY_SKILL_LEVELS':
						case 'COMBAT_LEVELS':
						case 'PERKS':
						case 'TALENTS':
						case 'POWERS':
						case 'DISADVANTAGES':
							break;
						default:
							if (is_array($value)) {
								if (array_key_exists($key, $mergedskill)) {
//							echo "$spacer $key - ARRAY exists<br>";
									$subarray = [$key];
									$this->compareArrays($charskill, $mergedskill, $subarray, $depth + 1);
								} else {
									echo "$spacer $key: <b>ARRAY  - does not exist</b><br>";
									debug($subarray);
//									debug($charskill);
//									debug($mergedskill);
								}
							} else {
//						echo "$spacer $key: $value - " . (array_key_exists($key, $mergedskill) ? 'exists' : 'does not exist') . '<br>';
							}
							break;
					}
					if ($key == '@CHARACTERISTIC') {
						if ($charskill['@CHARACTERISTIC'] != 'GENERAL') {
							if ($mergedcharacteristic = $this->getSubarray($mergedskill, [$charskill['@CHARACTERISTIC']])) {
//								echo($spacer . 'Characteristic: ' . $charskill['@CHARACTERISTIC'] . ' found<br>');
//								debug($mergedcharacteristic);
							} else {
								debug($spacer . 'key: ' . $charskill['@CHARACTERISTIC'] . ' <b>has no mergedcharacteristic</b>');
								debug($mergedskill);
							}
						} else {
							//debug($mergedskill);
						}
					}
				}
			} else {
				debug('error building mergedskill subarray.');
			}
		} else {
			debug('error building charskill subarray.');
		}
	}

	function getSubarray($array, $keys) {
		foreach ($keys as $key) {
			if (array_key_exists($key, $array)) {
				$array = $array[$key];
			} else {
				return false;
			}
		}
		return $array;
	}



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

		// XML File Paths
		$Old_XML = $BaseFolder . $Old_XML_File; // Path to Old XML File. Values will be read from this file.
		$New_XML = $BaseFolder . $New_XML_File; // Path to New XML File.
		$Tmp_XML = "$Old_XML.tmp";
		$Merged_XML = $BaseFolder . "Merged_XML_File.xml"; // Path to generated new XML File. 
		$Schema_XSD = ""; // Path to Schema XSD File. 

		$Same_Field_List = array(); // List of Parent/Child field 

		// Simple XML Elements 
		$Old_XML_SXE = new SimpleXMLElement($Old_XML, null, true);
		$New_XML_SXE = new SimpleXMLElement($New_XML, null, true);

		// Update XML File 
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

	//Function to vaildate schema XSD of a XML file

	function SchemaValidate($xml_file, $xsd_file) {
		$xml = new DOMDocument();
		$xml->load($xml_file);

		if (!$xml->schemaValidate($xsd_file)) {
			return 0;
		} else {
			return 1;
		}
	}

	// Function to constructively merge new XML file with values from old XML file 

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
			// echo "DEBUG: Parent is : $parent_name && Key is : $key && Child is : $child <br>\n";
			  echo "DEBUG: New [$i] Parent is : ".$New_xml[0]->getName()." && Key is : ".$New_xml[0]->$key->getName()." && Child is : ".$New_xml[0]->$key." <br>\n";
			  if ($New_xml->$key->getName() != $key) {
			  echo "DEBUG: New Field Found !!! <br>\n";
			  continue;
			  } 

			// Check if there are any fields which have same Parent/Field Name? If they have same name then 
			  they needs to be updated in a different manner. 
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

			// Check if a field is available in Old XML file. If that field is
			 * not available then there is no need to update new field values with
			 * old ones and so we will use new fields and its value and skip old
			 * xml file for that field. 
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

	// A recursive function to list XML file values 

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
*/
	 
}
