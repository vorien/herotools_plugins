<?php

namespace MFC\HDParser\Controller;

use MFC\HDParser\Controller\AppController;
//use Cake\ORM\TableRegistry;
//use Cake\Utility\Inflector;
//use App\Model\Entity;
//use Cake\Mailer\Email;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Core\Plugin;
use Cake\Cache\Cache;
use Cake\Core\Configure;

/**
 * CakePHP CharactersheetController
 * @author Michael
 */
class CharactersheetController extends AppController {

	public $HDPFiles;

	public function initialize() {
		parent::initialize();
		$this->HDPFiles = Plugin::path('Vorien/HDParser') . 'webroot' . DS . 'files/';
		$this->loadComponent('Vorien/HDParser.HDPCore');
		$this->loadComponent('Vorien/HDParser.HDPXML');
		$this->loadComponent('Vorien/HDParser.HDPStandardize');
		$this->loadComponent('Vorien/HDParser.HDPSkillDisplay');
		$this->loadComponent('Vorien/HDParser.HDPSections');
		$this->loadComponent('Vorien/HDParser.HDPArray');
	}

	function display() {
//		debug(func_get_args()[0]);
		$print = func_get_args()[0];
//		debug($print);
		$files = Cache::readMany([ 'character', 'main'], 'charactersheet');
		if (empty($files['character']) || empty($files['main'])) {
			$this->Flash->set('You need to select a Character and a Base Template before displaying your character');
			return $this->routeAction(true);
		}

		$characterfile = $files['character'];
		$mainfile = $files['main'];

//		debug($characterfile);
//		debug($mainfile);

		$character_xml = simplexml_load_file($characterfile);
		$main_xml = simplexml_load_file($mainfile);
		$template_xml = $character_xml->TEMPLATE;

		$xmlstarttring = '<?xml version="1.0" encoding="UTF-8"?>';

		$character_array = $this->HDPArray->objectToArray($character_xml);
		unset($character_array['TEMPLATE']);
		unset($character_array['RULES']);
		$template_array = $this->HDPArray->objectToArray($character_xml->TEMPLATE);
		$rules_array = $this->HDPArray->objectToArray($character_xml->RULES);
		$main_array = $this->HDPArray->objectToArray($main_xml);

		$character_clean = $this->HDPArray->removeEmptyArrayKeys($character_array);
		$template_clean = $this->HDPArray->removeEmptyArrayKeys($template_array);
		$rules_clean = $this->HDPArray->removeEmptyArrayKeys($rules_array);
		$main_clean = $this->HDPArray->removeEmptyArrayKeys($main_array);

		$this->HDPCore->moveEnhancers($character_clean);

		$character_standardized = $this->HDPStandardize->standardizeArray($character_clean);
		$template_standardized = $this->HDPStandardize->standardizeArray($template_clean);
		$main_standardized = $this->HDPStandardize->standardizeArray($main_clean);

		$mainplustemplate = array_replace_recursive($main_standardized, $template_standardized);

		$mergedCharacter = $this->HDPStandardize->mergeCharacterAndTemplate($character_standardized, $mainplustemplate);

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

		foreach ($mergedCharacter['CHARACTERISTICS'] as $key => $characteristic) {
			$cdisplayarray = $this->HDPSkillDisplay->getCharacteristicDisplay($characteristic, $rules_clean['attributes'][$key . "_MAX"]);
			$characteristics[$key] = $cdisplayarray;
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



		$agility_skills_list = array("Acrobatics", "Breakfall", "Climbing", "Combat Driving", "Combat Piloting", "Contortionist", "Fast Draw", "Lockpicking", "Riding", "Sleight Of Hand", "Stealth", "Teamwork");
		$intellect_skills_list = array("Analyze", "Bugging", "Computer Programming", "Concealment", "Cramming", "Criminology", "Cryptography", "Deduction", "Demolitions", "Disguise", "Electronics", "Forensic Medicine", "Forgery", "Gambling", "Inventor", "Lipreading", "Mechanics", "Mimicry", "Navigation", "Paramedics", "Security Systems", "Shadowing", "Survival", "Systems Operation", "Tactics", "Tracking", "Ventriloquism", "Weaponsmith");
		$interaction_skills_list = array("Acting", "Animal Handler", "Bribery", "Bureaucratics", "Charm", "Conversation", "High Society", "Interrogation", "Oratory", "Persuasion", "Streetwise", "Trading");

		$agility_skills = array_map("strtoupper", array_map(array($this->HDPCore, 'replaceSpacesWithUnderscores'), $agility_skills_list));
		$intellect_skills = array_map("strtoupper", $intellect_skills_list);
		$interaction_skills = array_map("strtoupper", $interaction_skills_list);

		foreach ($mergedCharacter['SKILLS'] as $key => $value) {
			$arraykeycount = $this->HDPArray->getArrayKeyCount($value);
			if ($this->HDPCore->hasAttributes($value) && $arraykeycount == 1) {
				$skills[$key] = $this->HDPSkillDisplay->getSkillDisplay($value, $characteristics);
			} else {
				switch ($key) {
					case "PROFESSIONAL_SKILL":
					case "KNOWLEDGE_SKILL":
						foreach ($value as $bkey => $bvalue) {
							$skills[$bvalue['attributes']['ALIAS'] . ": " . $bkey] = $this->HDPSkillDisplay->getBackgroundSkillDisplay($bvalue, $characteristics);
						}
						break;
					case "TRANSPORT_FAMILIARITY":
					case "WEAPON_FAMILIARITY":
						$skills[$value['attributes']['DISPLAY']] = $this->HDPSkillDisplay->getFamiliaritySkillDisplay($value);
						break;
					case "TWO_WEAPON_FIGHTING_HTH";
					case "DEFENSE_MANEUVER";
						$skills[$key] = $this->HDPSkillDisplay->getNoRollSkillDisplay($value);
						break;
					case "LANGUAGES";
						foreach ($value as $lkey => $lvalue) {
							$skills["Language" . ": " . $lkey] = $this->HDPSkillDisplay->getLanguageDisplay($lvalue);
						}
						break;
					case "COMBAT_LEVELS":
					case "PENALTY_SKILL_LEVELS":
						$expr = '/\b\w/';
						preg_match_all($expr, implode(' ', explode('_', $key)), $matches);
						$prefix = strtoupper(implode('', $matches[0])) . ": ";
						foreach ($value as $lvalue) {
							foreach ($lvalue as $lsubkey => $lsubvalue) {
								$skills[$prefix . $lsubkey] = $this->HDPSkillDisplay->getListSkillDisplay($lsubvalue, $prefix);
							}
						}
						break;
					case "SKILL_LEVELS":
						foreach ($value as $skey => $sval) {
							if (!$this->HDPCore->hasAttributes($sval)) {
								foreach ($sval as $subskey => $subsval) {
									if ($this->HDPCore->hasAttributes($subsval)) {
										$svalue = $sval[$subskey];
									}
								}
							} else {
								$svalue = $sval;
							}
							$skills["SL: " . $skey] = $this->HDPSkillDisplay->getSkillLevelDisplay($svalue);
						}
						break;
					default:
						if ($arraykeycount == 1) {
							foreach ($value as $dkey => $dvalue) {
								if ($this->HDPCore->hasAttributes($dvalue)) {
									$skills[$key . " - " . $dkey] = $this->HDPSkillDisplay->getSkillDisplay($dvalue, $characteristics);
								}
							}
						} else {
							$skills[$key] = $this->HDPSkillDisplay->getMultiLevelSkillDisplay($value, $characteristics);
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
						$checkarray = array_map("strtoupper", array_map(array($this->HDP, 'replaceSpacesWithUnderscores'), array_keys($value['affects'])));
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
			$talents[$key] = $this->HDPSections->getTalents($value);
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

		$perks = $this->HDPSections->getRawData($character_clean['PERKS']);


		$activespells = array();
		$castspells = array();

		$powers = $this->HDPSections->getPowers($mergedCharacter['POWERS']);
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
		$complications = $this->HDPSections->getRawData($mergedCharacter['DISADVANTAGES']);
//		debug($complications['Blue Lock of Hair']);
//		foreach($mergedCharacter['DISADVANTAGES'] as $key => $complication){
//			debug($key);
//			debug($complication);
//		}
//		exit;

		$this->HDPCore->sortOnTwoKeys($skills, 'type', 'display');

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
			$this->viewBuilder()->layout('Vorien/HDParser.csheet/display');
		} else {
			$this->viewBuilder()->layout('Vorien/HDParser.csheet/print');
		}
		$this->render('Vorien/HDParser.display');
	}

	public function select() {
//		debug("In select");
		if (!Cache::deleteMany([ 'character', 'main'], 'charactersheet')) { // deleting cache entries
			$this->Flash->set("Unable to delete cache entries");
//			debug(Cache::deleteMany([ 'character', 'main'], 'charactersheet'));
		}
		$characterfiles = [];
		$templates = [];
		$dir = new Folder($this->HDPFiles);
		$characterfiles = $dir->find('.*\.hdc');
		$templates = $dir->find('.*\.hdt');
		$this->set(compact('characterfiles', 'templates'));
	}

	public function index() {
//		debug("post: " . ($this->request->is('post') ? 'Yes' : 'No'));
//		debug("data-action: " . (!empty($this->request->data['action']) ? 'Yes' : 'No'));
		if (!$this->request->is('post') || empty($this->request->data['action'])) { // Must be a post with the action set
//			debug("post or action not set");
			return $this->routeAction(true);
		}
//		debug("data-character: " . (!empty($this->request->data['character']) ? 'Yes' : 'No'));
//		debug("data-main: " . (!empty($this->request->data['main']) ? 'Yes' : 'No'));
		if (empty($this->request->data['character']) || empty($this->request->data['main'])) {
//			debug("Checking cache for file names");
			if ($result = Cache::readMany([ 'character', 'main'], 'charactersheet')) { // Cache is set
//				debug("Cache is set");
//				debug($result);
				return $this->routeAction();
			} else {
//				debug("Cache is not set");
				return $this->routeAction(true);
			}
		} else {
//			debug("file names set in request-data");
//			debug("Trying to set cache");
			if (Cache::writeMany([
						'character' => $this->HDPFiles . $this->request->data['character'],
						'main' => $this->HDPFiles . $this->request->data['main']
							], 'charactersheet')) {
				unset($this->request->data['character']);
				unset($this->request->data['main']);
//				debug("Cache loaded successfully");
				return $this->routeAction();
			} else {
//				debug("Unable to load cache");
				return $this->routeAction(true);
			}
		}
		debug("No routing occurred");
	}

	public function upload() {
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
				$filename = $this->HDPFiles . $this->request->data['file']['name'];
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

	public function routeAction($select = false) {
		if ($select) {
			$this->setAction('select');
		} else {
//			debug($this->request->data['action']);
			switch ($this->request->data['action']) {
				case 'display':
					$this->setAction('display', 'display');
					break;
				case 'print':
					$this->setAction('display', 'print');
					break;
				case 'upload':
					unset($this->request->data['action']);
					$this->setAction('upload');
					break;
				case 'file':
					$this->setAction('upload');
					break;
				case 'change':
					break;
				default:
					$this->setAction('select');
					break;
			}
		}
		unset($this->request->data['action']);
	}

}
