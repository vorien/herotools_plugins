<?php

namespace Vorien\HeroCSheet\Controller;

use Vorien\HeroCSheet\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Plugin;
use Cake\Utility\Xml;
use Cake\Core\App;

/**
 * Charactersheets Controller
 *
 * @property \Vorien\HeroCSheet\Model\Table\CharactersheetsTable $Charactersheets
 */
class CharactersheetsController extends AppController {

	public $PFiles;
	public $cpath;
	public $mpath;
	public $tpath;
	public $carray = [];

	public function initialize() {
		parent::initialize();
		$this->loadComponent('Vorien/Dashboard.Ownership');
		$this->loadComponent('Vorien/Dashboard.DisplayFunctions');
//		$this->loadComponent('Vorien/HeroCSheet.PCore');
		$this->loadComponent('Vorien/HeroCSheet.PXML');
//		$this->loadComponent('Vorien/HeroCSheet.PStandardize');
//		$this->loadComponent('Vorien/HeroCSheet.PSkillDisplay');
//		$this->loadComponent('Vorien/HeroCSheet.PSections');
//		$this->loadComponent('Vorien/HeroCSheet.PArray');
		$this->PFiles = Plugin::path('Vorien/HeroCSheet') . 'webroot' . DS . 'files/';
	}

	public function beforeRender(Event $event) {
		parent::beforeRender($event);
		$this->viewBuilder()->helpers(['Vorien/Dashboard.Display']);
	}

	function compareXML($character_id) {

		$xmlfiles = $this->getXMLFilesForCharacterID($character_id);

		$template_xml = new \DOMDocument;
		$template_xml->preserveWhiteSpace = false;
		$template_xml->loadXML($xmlfiles['character_sxml']->TEMPLATE->saveXML());
		unset($xmlfiles['character_sxml']->TEMPLATE);
		$rules_xml = new \DOMDocument;
		$rules_xml->preserveWhiteSpace = false;
		$rules_xml->loadXML($xmlfiles['character_sxml']->RULES->saveXML());
		unset($xmlfiles['character_sxml']->RULES);
		$character_xml = dom_import_simplexml($xmlfiles['character_sxml'])->ownerDocument;
		$main_xml = dom_import_simplexml($xmlfiles['main_sxml'])->ownerDocument;

		$this->PXML->moveEnhancers($character_xml);

		$this->PXML->renameElement($character_xml->documentElement, 'HEROCSHEET');
		$this->PXML->renameElement($main_xml->documentElement, 'HEROCSHEET');
		$this->PXML->renameElement($template_xml->documentElement, 'HEROCSHEET');


		$this->cpath = new \DOMXPath($character_xml);
		$this->mpath = new \DOMXPath($main_xml);
		$this->tpath = new \DOMXPath($template_xml);

		$this->PXML->standardizeTemplate($this->mpath);
		$this->PXML->standardizeTemplate($this->tpath);

		$removenames = ['EXAMPLE'];
		$this->PXML->removeNamedTags($character_xml, $removenames);
		$this->PXML->removeNamedTags($main_xml, $removenames);
		$this->PXML->removeNamedTags($template_xml, $removenames);

		$this->PXML->removeEmptyTags($character_xml);
		$this->PXML->removeEmptyTags($main_xml);
		$this->PXML->removeEmptyTags($template_xml);
		$this->PXML->removeEmptyTags($rules_xml);

		file_put_contents($this->PFiles . 'main_standardized.xml', $main_xml->saveXML());
		file_put_contents($this->PFiles . 'template_standardized.xml', $template_xml->saveXML());
		file_put_contents($this->PFiles . 'character_standardized.xml', $character_xml->saveXML());
		file_put_contents($this->PFiles . 'rules_standardized.xml', $rules_xml->saveXML());

		$this->loadComponent('Vorien/HeroCSheet.PMergeTemplates', [
			'to_xml' => $main_xml,
			'from_xml' => $template_xml,
			'basequery' => '/HEROCSHEET'
				]
		);
		$merge_xml = $this->PMergeTemplates->mergeTemplates();
		file_put_contents($this->PFiles . 'merged_templates.xml', $merge_xml->saveXML());

		$mpath = new \DomXPath($merge_xml);
		
//		$testitem = $mpath->query('/HEROCSHEET')->item(0);
//		debug();
//		$testitem = $mpath;
//		debug(gettype($testitem) !== 'object' ?gettype($testitem): get_class($testitem));
//		$testitem = $main_xml;
//		debug(gettype($testitem) !== 'object' ?gettype($testitem): get_class($testitem));
//		$testitem = 'blah blah';
//		debug(gettype($testitem) !== 'object' ?gettype($testitem): get_class($testitem));
//		$testitem = '#blah blah';
//		debug(gettype($testitem) !== 'object' ?gettype($testitem): get_class($testitem));
//		$testitem = 247;
//		debug(gettype($testitem) !== 'object' ?gettype($testitem): get_class($testitem));
//		exit;
//		
//		$xpatharray = [
//			'//DOESNOTXIST'
////			,'//ADDER/ADDER'
////			,'//ADDER/MODIFIER'
////			,'//ADDER/OPTION'
//			,'//ADDER/OPTION/ADDER'
//			,'//ADDER/OPTION/MODIFIER'
////			,'//MODIFIER/ADDER'
////			,'//MODIFIER/MODIFIER'
////			,'//MODIFIER/OPTION'
//			,'//MODIFIER/OPTION/ADDER'
//			,'//MODIFIER/OPTION/MODIFIER'
////			,'//OPTION/ADDER'
////			,'//OPTION/MODIFIER'
////			,'//OPTION/OPTION'
////			,'//ADDER[@OPTIONID]'
////			,'//ADDER[@OPTIONID]/ADDER'
////			,'//ADDER[@OPTIONID]/MODIFIER'
////			,'//ADDER[@OPTIONID]/ADDER/ADDER'
////			,'//ADDER[@OPTIONID]/ADDER/MODIFIER'
////			,'//ADDER[@OPTIONID]/MODIFIER/ADDER'
////			,'//ADDER[@OPTIONID]/MODIFIER/MODIFIER'
//
////			,'//MODIFIER[@OPTIONID]'
////			,'//MODIFIER[@OPTIONID]/ADDER'
////			,'//MODIFIER[@OPTIONID]/MODIFIER'
////			,'//MODIFIER[@OPTIONID]/ADDER/ADDER'
////			,'//MODIFIER[@OPTIONID]/ADDER/MODIFIER'
////			,'//MODIFIER[@OPTIONID]/MODIFIER/ADDER'
////			,'//MODIFIER[@OPTIONID]/MODIFIER/MODIFIER'
//
//			];
//		foreach ($xpatharray as $xpath) {
//			$nodelist = $this->mpath->query($xpath);
//			echo $xpath, ',', $nodelist->length, '<br>';
//			foreach ($nodelist as $node) {
//				while($node->parentNode){
//					echo $node->getNodePath(), ': ', $node->getAttribute('XMLID'), ' / ', $node->getAttribute('OPTIONID'), '<br>';
//					$node = $node->parentNode;
//				}
//			}
//		}





		$this->loadComponent('Vorien/HeroCSheet.PMergeCharacter', [
			'character_xml' => $character_xml,
			'merged_xml' => $merge_xml,
			'basequery' => '/HEROCSHEET/POWERS'
				]
		);
		$mergedcharacter_xml = $this->PMergeCharacter->mergeCharacter();
		debug($mergedcharacter_xml->saveXML());
		file_put_contents($this->PFiles . 'merged_character.xml', $mergedcharacter_xml->saveXML());
	}

	function getNodeByXmlid($xmlid, $nodelist) {
		debug($xmlid);
		foreach ($nodelist as $item) {
			if ($item->nodeType == XML_TEXT_NODE) {
				continue;
			}
			debug($item->getAttribute('XMLID'));
			if ($item->getAttribute('XMLID') == $xmlid) {
				return $item;
			}
		}
		return false;
	}

	function getXMLID($node) {
		if ($node->hasAttribute('XMLID')) {
			return $node->getAttribute('XMLID');
		} else {
			return null;
		}
	}

	function showParentNodes($node, $showxmlid = false) {
		while (substr($node->parentNode->nodeName, 0, 1) != '#') {
			$xmlid = $pxmlid = '';
			if ($showxmlid) {
				if ($xmlid = $this->getXMLID($node)) {
					$xmlid = " [$xmlid]";
				}
				if ($pxmlid = $this->getXMLID($node->parentNode)) {
					$pxmlid = " [$xmlid]";
				}
			}
			echo $node->nodeName, $xmlid, ' -> ', $node->parentNode->nodeName, $pxmlid, '<br>';
			$node = $node->parentNode;
		}
	}

//	function mergeAttributes($xpath) {
//		debug($xpath);
//		$mergedocument = new \DOMDocument();
//		$mergeelement = $mergedocument->createElement('MERGE_ELEMENT');
//		$mergedocument->appendChild($mergeelement);
//
//		$cnodequery = $xpath . $this->PXML->skipemptynodes;
//		$cnodelist = $this->cpath->query($cnodequery);
//		foreach ($cnodelist as $cnode) {
//			if (!$cnode->hasAttributes() || $cnode->nodeType == XML_TEXT_NODE) {
//				echo '<br><span style="font-size: 3em; font-weight: bold;">', $cnode->nodeName, '</span><br><br>';
//				continue;
//			} else {
//				debug($cnode->getNodePath());
//				$nodequery = preg_replace('/\[[0-9]+\]/', '', $cnode->getNodePath()) . $this->PXML->skipempty;
//				debug($nodequery);
//				if ($mnode = $this->getMatchingNode($cnode, $nodequery, $this->mpath)) {
//					foreach ($mnode->attributes as $attribute) {
//						$mergeelement->setAttribute($attribute->name, $attribute->value);
//					}
//				} else {
//					debug('No matching item in merged_xml for ' . $cnode->nodeName . ' at ' . $cnode->getNodePath());
//					$this->showParentNodes($cnode, true);
//					$bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
//					$btline = [];
//					for ($ctr = 0; $ctr < 10; $ctr++) {
//						$btline[$ctr] = array_shift($bt);
//					}
//					debug($btline);
//					die();
//				}
//
//				foreach ($cnode->attributes as $attribute) {
//					$mergeelement->setAttribute($attribute->name, $attribute->value);
//				}
//				foreach ($mergeelement->attributes as $attribute) {
//					$cnode->setAttribute($attribute->name, $attribute->value);
//				}
////			if ($cnode->hasChildNodes()) {
//				foreach ($cnode->childNodes as $child) {
//					$childquery = preg_replace('/\[[0-9]+\]/', '', $child->getNodePath());
//					$this->mergeAttributes($childquery);
//				}
////			}
//			}
//		}
//	}

	function getXMLFilesForCharacterID($character_id) {
		if (empty($character_id)) {
			$this->Flash->set('No character was selected');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}
		$charactersheet = $this->Charactersheets->find('all')->where(['character_id' => $character_id])->first();
		if (empty($charactersheet)) {
			$this->Flash->set('There is no entry in the table for that character');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}
		if (empty($charactersheet['characterfile'])) {
			$this->Flash->set('There is no character file set for that character');
			return $this->redirect(['plugin' => 'Vorien/HeroCSheet', 'controller' => 'charactersheets', 'action' => 'upload']);
		}
		if (empty($charactersheet['mainfile'])) {
			$this->Flash->set('There is no main file set for that character.<br>Contact your GM for more information.');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}

		$characterfile = $this->PFiles . $charactersheet['characterfile'];
		$mainfile = $this->PFiles . $charactersheet['mainfile'];

		$character_sxml = simplexml_load_file($characterfile);
		$main_sxml = simplexml_load_file($mainfile);


		$character_xml = new \DOMDocument();
		$character_xml->preserveWhiteSpace = false;
		$character_xml->load($characterfile);

		$main_xml = new \DOMDocument();
		$main_xml->preserveWhiteSpace = false;
		$main_xml->load($mainfile);

		return compact('character_sxml', 'main_sxml', 'character_xml', 'main_xml');
	}

	/*
	  public function display($character_id) {
	  $skillenhancers = array("KS" => 0, "AK" => 0, "PS" => 0, "CuK" => 0);
	  foreach ($mergedCharacter['SKILL_ENHANCERS'] as $key => $characteristic) {
	  switch ($key) {
	  case "JACK_OF_ALL_TRADES":
	  $skillenhancers["PS"] = 1;
	  break;
	  case "SCHOLAR":
	  $skillenhancers["KS"] = 1;
	  break;
	  case "TRAVELER":
	  $skillenhancers["AK"] = 1;
	  $skillenhancers["CuK"] = 1;
	  break;
	  }
	  }


	  $mergedCharacter['SKILLS']['PERCEPTION'] = array(
	  'attributes' => array(
	  'XMLID' => 'PERCEPTIOM',
	  'SHOWDIALOG' => 'No',
	  'DISPLAY' => 'Perception',
	  'MINCOST' => '0',
	  'EXCLUSIVE' => 'Yes',
	  'CHARACTERISTIC' => 'INT',
	  'BASECOST' => '0',
	  'LVLCOST' => '3',
	  'LVLVAL' => '1',
	  'ID' => '1351803027794',
	  'LEVELS' => '0',
	  'ALIAS' => 'Perception',
	  'POSITION' => '28',
	  'MULTIPLIER' => '1.0',
	  'GRAPHIC' => 'Burst',
	  'COLOR' => '255 255 255',
	  'SFX' => 'Default',
	  'SHOW_ACTIVE_COST' => 'No',
	  'INCLUDE_NOTES_IN_PRINTOUT' => 'No',
	  'FAMILIARITY' => 'No',
	  'PROFICIENCY' => 'No',
	  'LEVELSONLY' => 'No'
	  )
	  );



	  $agility_skillslist = array("Acrobatics", "Breakfall", "Climbing", "Combat Driving", "Combat Piloting", "Contortionist", "Fast Draw", "Lockpicking", "Riding", "Sleight Of Hand", "Stealth", "Teamwork");
	  $intellect_skillslist = array("Analyze", "Bugging", "Computer Programming", "Concealment", "Cramming", "Criminology", "Cryptography", "Deduction", "Demolitions", "Disguise", "Electronics", "Forensic Medicine", "Forgery", "Gambling", "Inventor", "Lipreading", "Mechanics", "Mimicry", "Navigation", "Paramedics", "Security Systems", "Shadowing", "Survival", "Systems Operation", "Tactics", "Tracking", "Ventriloquism", "Weaponsmith");
	  $interaction_skillslist = array("Acting", "Animal Handler", "Bribery", "Bureaucratics", "Charm", "Conversation", "High Society", "Interrogation", "Oratory", "Persuasion", "Streetwise", "Trading");

	  $agility_skills = array_map("strtoupper", array_map(array($this->PCore, 'replaceSpacesWithUnderscores'), $agility_skillslist));
	  $intellect_skills = array_map("strtoupper", $intellect_skillslist);
	  $interaction_skills = array_map("strtoupper", $interaction_skillslist);

	  foreach ($mergedCharacter['SKILLS'] as $key => $value) {
	  $arraykeycount = $this->PArray->getArrayKeyCount($value);
	  if ($this->PCore->hasAttributes($value) && $arraykeycount == 1) {
	  $skills[$key] = $this->PSkillDisplay->getSkillDisplay($value, $characteristics);
	  } else {
	  switch ($key) {
	  case "PROFESSIONAL_SKILL":
	  case "KNOWLEDGE_SKILL":
	  foreach ($value as $bkey => $bvalue) {
	  $skills[$bvalue['attributes']['ALIAS'] . ": " . $bkey] = $this->PSkillDisplay->getBackgroundSkillDisplay($bvalue, $characteristics);
	  }
	  break;
	  case "TRANSPORT_FAMILIARITY":
	  case "WEAPON_FAMILIARITY":
	  $skills[$value['attributes']['DISPLAY']] = $this->PSkillDisplay->getFamiliaritySkillDisplay($value);
	  break;
	  case "TWO_WEAPON_FIGHTING_HTH";
	  case "DEFENSE_MANEUVER";
	  $skills[$key] = $this->PSkillDisplay->getNoRollSkillDisplay($value);
	  break;
	  case "LANGUAGES";
	  foreach ($value as $lkey => $lvalue) {
	  $skills["Language" . ": " . $lkey] = $this->PSkillDisplay->getLanguageDisplay($lvalue);
	  }
	  break;
	  case "COMBAT_LEVELS":
	  case "PENALTY_SKILL_LEVELS":
	  $expr = '/\b\w/';
	  preg_match_all($expr, implode(' ', explode('_', $key)), $matches);
	  $prefix = strtoupper(implode('', $matches[0])) . ": ";
	  foreach ($value as $lvalue) {
	  foreach ($lvalue as $lsubkey => $lsubvalue) {
	  $skills[$prefix . $lsubkey] = $this->PSkillDisplay->getListSkillDisplay($lsubvalue, $prefix);
	  }
	  }
	  break;
	  case "SKILL_LEVELS":
	  foreach ($value as $skey => $sval) {
	  if (!$this->PCore->hasAttributes($sval)) {
	  foreach ($sval as $subskey => $subsval) {
	  if ($this->PCore->hasAttributes($subsval)) {
	  $svalue = $sval[$subskey];
	  }
	  }
	  } else {
	  $svalue = $sval;
	  }
	  $skills["SL: " . $skey] = $this->PSkillDisplay->getSkillLevelDisplay($svalue);
	  }
	  break;
	  default:
	  if ($arraykeycount == 1) {
	  foreach ($value as $dkey => $dvalue) {
	  if ($this->PCore->hasAttributes($dvalue)) {
	  $skills[$key . " - " . $dkey] = $this->PSkillDisplay->getSkillDisplay($dvalue, $characteristics);
	  }
	  }
	  } else {
	  $skills[$key] = $this->PSkillDisplay->getMultiLevelSkillDisplay($value, $characteristics);
	  }
	  break;
	  }
	  }
	  }

	  foreach ($skills as $key => $value) {
	  if (substr($key, 0, 3) === "SL:") {
	  $levels = $value['levels'] * 1;
	  $option = $value['option'];
	  switch ($option) {
	  case 'AGILITY':
	  $checkarray = $agility_skills;
	  break;
	  case 'INTELLECT':
	  $checkarray = $intellect_skills;
	  break;
	  case 'INTERACTION':
	  $checkarray = $interaction_skills;
	  break;
	  case 'RELATED':
	  $checkarray = array_map("strtoupper", array_map(array($this->P, 'replaceSpacesWithUnderscores'), array_keys($value['affects'])));
	  break;
	  default:
	  break(2);
	  }

	  foreach ($skills as $skillkey => $skillvalue) {
	  $keyfound = array_search($skillvalue['id'], $checkarray);
	  if ($keyfound !== false && $skillvalue['familiarity'] != 'Yes') {
	  $skills[$skillkey]['levels'] += $levels;
	  }
	  }
	  }
	  }

	  foreach ($skills as $key => $value) {
	  if (array_key_exists($value['type'], $skillenhancers)) {
	  if ($skillenhancers[$value['type']] == 1) {
	  $skills[$key]['cost'] -= 1;
	  }
	  }
	  }

	  foreach ($mergedCharacter['TALENTS'] as $key => $value) {
	  $talents[$key] = $this->PSections->getTalents($value);
	  }

	  if (array_key_exists('STRIKING_APPEARANCE', $talents)) {
	  foreach ($talents as $key => $value) {
	  if ($key == 'STRIKING_APPEARANCE' && array_key_exists('affects', $value)) {
	  foreach ($value['affects'] as $affects) {
	  if (array_key_exists(strtoupper($affects), $skills)) {
	  $skills[strtoupper($affects)]['star'] = true;
	  }
	  }
	  }
	  }
	  }

	  $perks = $this->PSections->getRawData($character_clean['PERKS']);


	  $activespells = array();
	  $castspells = array();

	  $powers = $this->PSections->getPowers($mergedCharacter['POWERS']);
	  foreach ($powers as $key => $value) {
	  if (!empty($value['skillroll'])) {
	  $castspells[$key] = $value;
	  } else {
	  $activespells[$key] = $value;
	  if ($powers[$key]['xmlid'] === 'ENHANCEDPERCEPTION' && $powers[$key]['option'] === 'ALL') {
	  $skills['PERCEPTION']['levels'] += $powers[$key]["levels"];
	  }
	  if ($powers[$key]['xmlid'] === 'ENHANCEDPERCEPTION' && $powers[$key]['option'] !== 'ALL') {
	  $skills['PERCEPTION']['star'] = true;
	  }
	  }
	  }


	  //		debug($mergedCharacter['DISADVANTAGES']['DISTINCTIVEFEATURES']['Blue Lock of Hair']);
	  //
	  $complications = $this->PSections->getRawData($mergedCharacter['DISADVANTAGES']);
	  //		debug($complications['Blue Lock of Hair']);
	  //		foreach($mergedCharacter['DISADVANTAGES'] as $key => $complication){
	  //			debug($key);
	  //			debug($complication);
	  //		}
	  //		exit;

	  $this->PCore->sortOnTwoKeys($skills, 'type', 'display');

	  $backgroundskills = array();
	  $norollskills = array();
	  $regularskills = array();

	  foreach ($skills as $key => $value) {
	  if (array_key_exists($value['type'], $skillenhancers)) {
	  $backgroundskills[$key] = $skills[$key];
	  } elseif (empty($value['roll'])) {
	  $norollskills[$key] = $skills[$key];
	  } else {
	  $regularskills[$key] = $skills[$key];
	  }
	  }


	  $this->set('title_for_layout', 'Character Sheet');

	  //		$powers = $mergedCharacter['POWERS'];
	  //		$viewdata = compact('characteristics', 'skills', 'perks', 'talents', 'powers', 'regularskills', 'backgroundskills', 'norollskills', 'activespells', 'castspells', 'complications');
	  $this->set(compact('characteristics', 'skills', 'perks', 'talents', 'powers', 'regularskills', 'backgroundskills', 'norollskills', 'activespells', 'castspells', 'complications', 'print'));

	  //		debug($viewdata);
	  if ($print == 'display') {
	  $this->viewBuilder()->layout('Vorien/HeroCSheet.csheet/display');
	  } else {
	  $this->viewBuilder()->layout('Vorien/HeroCSheet.csheet/print');
	  }
	  $this->render('Vorien/HeroCSheet.display');
	  }

	  public function upload() {
	  if ($this->request->is('post')) {
	  if (!empty($this->request->data)) {
	  $filename = $this->PFiles . $this->request->data['file']['name'];
	  if (move_uploaded_file($this->request->data['file']['tmp_name'], $filename)) {
	  $this->Flash->set('File uploaded successfuly.');
	  $this->request->data = [];
	  $this->request->data['action'] = 'index';
	  $this->routeAction();
	  } else {
	  $this->Flash->set('There was a problem uploading file. Please try again.');
	  }
	  }
	  }
	  }
	 */

	/**
	 * View method
	 *
	 * @param string|null $id Charactersheet id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null) {
		$charactersheet = $this->Charactersheets->get($id, [
			'contain' => ['Characters']
		]);

		$this->set('charactersheet', $charactersheet);
		$this->set('_serialize', ['charactersheet']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add() {
		$charactersheet = $this->Charactersheets->newEntity();
		if ($this->request->is('post')) {
			$charactersheet = $this->Charactersheets->patchEntity($charactersheet, $this->request->data);
			if ($this->Charactersheets->save($charactersheet)) {
				$this->Flash->success(__('The charactersheet has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The charactersheet could not be saved. Please, try again.'));
			}
		}
		$characters = $this->Charactersheets->Characters->find('list', ['limit' => 200]);
		$this->set(compact('charactersheet', 'characters'));
		$this->set('_serialize', ['charactersheet']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Charactersheet id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null) {
		$charactersheet = $this->Charactersheets->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$charactersheet = $this->Charactersheets->patchEntity($charactersheet, $this->request->data);
			if ($this->Charactersheets->save($charactersheet)) {
				$this->Flash->success(__('The charactersheet has been saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('The charactersheet could not be saved. Please, try again.'));
			}
		}
		$characters = $this->Charactersheets->Characters->find('list', ['limit' => 200]);
		$this->set(compact('charactersheet', 'characters'));
		$this->set('_serialize', ['charactersheet']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Charactersheet id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null) {
		$this->request->allowMethod(['post', 'delete']);
		$charactersheet = $this->Charactersheets->get($id);
		if ($this->Charactersheets->delete($charactersheet)) {
			$this->Flash->success(__('The charactersheet has been deleted.'));
		} else {
			$this->Flash->error(__('The charactersheet could not be deleted. Please, try again.'));
		}
		return $this->redirect(['action' => 'index']);
	}

}
