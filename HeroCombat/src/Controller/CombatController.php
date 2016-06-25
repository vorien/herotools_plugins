<?php

namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Plugin;

/**
 * CakePHP ProcessController
 * @author Michael
 */
class CombatController extends AppController {

	public function initialize() {
		parent::initialize();
//		$this->loadComponent('Vorien/HeroCombat.HCUTF');
		$this->loadComponent('Vorien/HeroCombat.Ownership');
		$this->loadComponent('Vorien/HeroCombat.ActiveCharacter');
		$this->loadComponent('Vorien/HeroCombat.DisplayFunctions');
//		$this->loadComponent('Vorien/HDParser.HDPXML');
//		$this->loadComponent('Vorien/HDParser.HDPStandardize');
//		$this->loadComponent('Vorien/HDParser.HDPSkillDisplay');
//		$this->loadComponent('Vorien/HDParser.HDPSections');
//		$this->loadComponent('Vorien/HDParser.HDPArray');
	}

	public function index($character_id) {
//		debug($this->Ownership->user());
//		exit;
		//Make sure the current user should have access to the selected character
		$this->Ownership->checkCharacterOwnership($character_id);

		//Set the active character in the session for faster reference
		$this->ActiveCharacter->setActiveCharacter($character_id);

		$ajax_root = '/herocombat/';
		$armorlocationinfo = $this->getArmorLocationInfo($character_id);
		$json_armorlocationinfo = json_encode($armorlocationinfo);

		$targetinfo = $this->getTargetInfo();
		$json_targetinfo = json_encode($targetinfo);

		$locationinfo = $this->getLocationInfo();
		$json_locationinfo = json_encode($locationinfo);

		$maneuvers_standard = $this->getManeuverList("Standard");
		$maneuvers_optional = $this->getManeuverList("Optional");

		$characterinfo = $this->getCharacterInfo($character_id);
		$json_characterinfo = json_encode($characterinfo);

		$weapons = $this->getAllWeaponInfo($character_id);
		$json_weapons = json_encode($weapons);

		$leveltracking = $this->getLevelTrackingArray($character_id);
		$json_leveltracking = json_encode($leveltracking);

		$starting_weapon_id = $this->getUnarmedCharacterWeapon($character_id);
		debug($starting_weapon_id);


//		debug($weapons);
//		debug($leveltracking);

		$this->set('title_for_layout', 'Combat Calculator');

		$this->set(compact('ajax_root', 'characterinfo', 'json_characterinfo', 'locationinfo', 'json_targetinfo', 'targetinfo', 'json_locationinfo', 'json_weapons', 'maneuvers_standard', 'maneuvers_optional', 'weapons', 'starting_weapon_id', 'armorlocationinfo', 'json_armorlocationinfo', 'leveltracking', 'json_leveltracking'));
	}

	public function getArmorLocationInfo($character_id) {
		if (!$character_id) {
			return [];
		}
		$data = TableRegistry::get('Vorien/HeroCombat.Characterprotections');
		$query = $data->find();
		$query->hydrate(false);
		$query->contain([
			'Locations' => function ($q) {
				return $q->select(['roll', 'location', 'sublocation'])
								->formatResults(function ($locations) {
									return $locations->map(function ($location) {
												$location['locationdata'] = $location['roll'] . ' - ' . $location['location'] . (!empty($location['sublocation']) ? ' (' . $location['sublocation'] . ')' : '');
												return $location;
											});
								});
//				return $q->select(['roll', 'location', 'sublocation']);
			},
					'Armors' => function ($q) {
				return $q->select(['armor', 'type', 'r_pd', 'r_ed'])
								->formatResults(function ($armors) {
									return $armors->map(function ($armor) {
												$armor['armordata'] = $armor['armor'] . ' (' . $armor['type'] . ')';
												return $armor;
											});
								});
			},
					'Materials' => function ($q) {
				return $q->select(['material', 'manufacture', 'option', 'r_pd', 'r_ed'])
								->formatResults(function ($materials) {
									return $materials->map(function ($material) {
												$material['materialdata'] = $material['material'] . ' - ' .
														(!empty($material['manufacture']) ? ' (' . $material['manufacture'] .
																(!empty($material['option']) ? ' / ' . $material['option'] : '') .
																')' : '');
												return $material;
											});
								});
			}
				]);
				$query->where([
					'Characterprotections.character_id' => $character_id,
					'Characterprotections.active' => true
				]);
				$armorlocationinfo = $query->all()->toArray();
				$this->DisplayFunctions->removeByKey($armorlocationinfo, ['created', 'modified']);
				return $armorlocationinfo;

//				$return = [];
//				foreach ($armorlocationinfo as $armor) {
//					$return[$value['Location']['roll']] = $value[0];
//					$return[$value['Location']['roll']]['armor'] = $value['Armor']['armor'];
//					$return[$value['Location']['roll']]['material'] = $value['Material']['material'];
//					$return[$value['Location']['roll']]['armor'] = $value['Armor']['armor'];
//					$return[$value['Location']['roll']]['r_pd'] = max(0, $return[$value['Location']['roll']]['r_pd']);
//					$return[$value['Location']['roll']]['r_ed'] = max(0, $return[$value['Location']['roll']]['r_ed']);
//				}
//				return $return;
			}

			public function getTargetInfo() {
				$return = [];
				$data = TableRegistry::get('Vorien/HeroCombat.Targets');

				$general = $data->find();
				$general->hydrate(false);
				$general->where(['type' => 'General']);
				$general->order(['sort_order ASC']);
				$return['general'] = $general->all()->toArray();

				$shot = $data->find();
				$shot->hydrate(false);
				$shot->where(['`type`' => 'Shot']);
				$shot->order(['sort_order ASC']);
				$return['shot'] = $shot->all()->toArray();

				$special = $data->find();
				$special->hydrate(false);
				$special->where(['type' => 'Special']);
				$special->order(['sort_order ASC']);
				$return['special'] = $special->all()->toArray();

				return $return;
			}

			public function getLocationInfo() {
				$data = TableRegistry::get('Vorien/HeroCombat.Locations');
				$query = $data->find();
				$query->hydrate(false);
				$query->contain(['Targets']);
				$query->formatResults(function ($locations) {
					return $locations->map(function ($location) {
								$location['locationdata'] = $location['roll'] . ' - ' . $location['location'] . (!empty($location['sublocation']) ? ' (' . $location['sublocation'] . ')' : '');
								return $location;
							});
				});
				$locationinfo = $query->all()->toArray();
				$this->DisplayFunctions->removeByKey($locationinfo, ['created', 'modified']);
//				debug($locationinfo);
				return $locationinfo;
//				$this->Location->unbindModel(array('hasMany' => array('Characterprotection', 'Coveringlocation')));
//				$locationinfo = $this->Location->find('all');
//				$return = array();
//				foreach ($locationinfo as $value) {
//					$return[$value['Location']['roll']]['Location'] = $value['Location'];
//					$return[$value['Location']['roll']]['Target'] = $value['Target'];
//				}
//				return $return;
			}

			public function getManeuverList($type = null) {
				$maneuverlist = array();
				if ($type) {
					$data = TableRegistry::get('Vorien/HeroCombat.Maneuvers');
					$query = $data->find();
					$query->where(['type' => $type]);
					$query->hydrate(false);
//				$query->contain([ 'Targets']);
					$maneuverlist = $query->all()->toArray();
					$this->DisplayFunctions->removeByKey($maneuverinfo, ['created', 'modified']);
				}
				return $maneuverlist;
			}

			public function getCharacterInfo($character_id = null) {
				if (!$character_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characters');
				$query = $data->find();
				$query->hydrate(false);
				$query->where(['Characters.id' => $character_id]);
				$characterinfo = $query->first();
				$this->DisplayFunctions->removeByKey($characterinfo, ['created', 'modified']);
				return $characterinfo;
			}

			public function getAllWeaponInfo($character_id) {
				if (!$character_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
				$query = $data->find();
				$query->hydrate(false);
				$query->contain(['Weapons']);
				$query->where(['Characterweapons.character_id' => $character_id]);

				$query->formatResults(function ($characterweapons) {
					return $characterweapons->map(function ($characterweapon) {
								foreach ($characterweapon['weapon'] as $wkey => $wvalue) {
									if ($wkey == 'weapon') {
										$characterweapon['base_weapon'] = $wvalue;
									} else {
										$characterweapon[$wkey] = $wvalue;
									}
								}
								unset($characterweapon['weapon']);
								return $characterweapon;
							});
				});

				$allweaponinfo = $query->all()->toArray();
				$this->DisplayFunctions->removeByKey($allweaponinfo, ['created', 'modified']);
//				debug($allweaponinfo);
//				exit;
				return $allweaponinfo;
			}

			public function getLevelTrackingArray($character_id) {
				if (!$character_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterlevels');
				$query = $data->find();
				$query->hydrate(false);
				$query->contain([
					'Levels',
					'Characterweapons'
				]);
				$query->where(['Characterlevels.character_id' => $character_id]);
				$leveltrackingarray = $query->all()->toArray();
				$this->DisplayFunctions->removeByKey($leveltrackingarray, ['created', 'modified']);
				return $leveltrackingarray;

//				$all_levels = $this->Characterlevel->find('all', array(
//					'conditions' => array(
//						'Characterlevel.character_id' => $character_id
//					),
//					'fields' => 'Characterlevel.qty',
//					'contain' => array(
//						'Level' => array(
//							'fields' => array(
//								'Level.cost',
//								'Level.color'
//							)
//						),
//						'Characterweapon.id'
//					),
//					'order' => 'Level.cost'
//				));
//
//				foreach ($all_levels as $lkey => $level) {
//					for ($ctr = 0; $ctr < $level['Characterlevel']['qty']; $ctr++) {
//						$levelarray = array();
//						$levelarray['claimed'] = false;
//						$levelarray['cost'] = intval($level['Level']['cost']);
//						$levelarray['color'] = $level['Level']['color'];
//						foreach ($level['Characterweapon'] as $cwkey => $cwvalue) {
//							$levelarray['weapons'][] = intval($cwvalue['id']);
//						}
//						$leveltrackingarray[] = $levelarray;
//					}
//				}
//
//				foreach ($leveltrackingarray as $ltakey => $ltavalue) {
//					$leveltrackingarray[$ltakey]['id'] = $ltakey;
//				}
//
//				return($leveltrackingarray);
			}

			public function getUnarmedCharacterWeapon($character_id) {
				if (!$character_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
				$query = $data->find();
				$query->hydrate(false);
				$query->select('id');
				$query->where([
					'Characterweapons.character_id' => $character_id,
					'Characterweapons.weapon_id' => 90
				]);
				$unarmedcharacterweapon = $query->first();
				$this->DisplayFunctions->removeByKey($unarmedcharacterweapon, ['created', 'modified']);
//				debug($unarmedcharacterweapon['id']);
//				exit;
				return $unarmedcharacterweapon['id'];
			}

			/*
			 * Functions below this line have not been migrated to CakePHP 3...
			 */

			public function listweapons($character_id) {
				$weaponlist = $this->Characterweapon->find('list', array(
					'fields' => array('Characterweapon.name'),
					'contain' => array('Weapon'),
					'order' => array('Weapon.type'),
					'conditions' => array('character_id' => $character_id)
				));

				return $weaponlist;
			}

			public function ajax_getcharacterinfo($character_id) {
				$this->autoRender = false;
				echo json_encode($this->getcharacterinfo($character_id));
			}

			public function ajax_getweapondata($character_id, $id) {
				$this->autoRender = false;
				echo json_encode($this->getWeaponData($character_id, $id));
			}

			public function getWeaponData($character_id, $id) {
//		$weapondata = $this->Characterweapon->find('all');
				$weapondata = $this->Characterweapon->find('first', array(
					'conditions' => array(
						'Characterweapon.character_id' => $character_id,
						'Characterweapon.id' => $id
					),
					'contain' => array(
						'Weapon'
					)
				));
				return $this->UTF->arrayToUTF8($weapondata);
			}

			public function getmartialmaneuvers($character_id = null, $mainid = 0) {
				$this->viewBuilder()->layout('Vorien/HeroCombat.default');
				$maneuverlist = array();

				if ($character_id) {

					$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
					$query = $data->find();
					$query->hydrate(false);
					$query->where([
						'Characterweapons.character_id' => $character_id,
						'Characterweapons.id' => $mainid,
						'Characterweapons.weapon_element' => 1
					]);
					$weaponelements = $query->count();

					if ($weaponelements > 0) {
						$data = TableRegistry::get('Vorien/HeroCombat.Charactermaneuvers');
						$query = $data->find();
						$query->hydrate(false);
						$query->where(['Charactermaneuvers.character_id' => $character_id]);
						$query->contain([
							'Maneuvers' => function ($q) {
								return $q->order(['type', 'sort_order']);
							}
								]);
								$base_maneuver = '';
								$query->formatResults(function ($charactermaneuvers) {
									return $charactermaneuvers->map(function ($charactermaneuver) {
												foreach ($charactermaneuver['maneuver'] as $mkey => $mvalue) {
													if ($mkey == 'maneuver') {
														$base_maneuver = $mvalue;
													} else {
														$charactermaneuver[$mkey] = $mvalue;
													}
												}
												unset($charactermaneuver['maneuver']);
												$charactermaneuver['maneuver'] = $base_maneuver;
												return $charactermaneuver;
											});
								});
								$maneuverlist = $query->all()->toArray();
								$this->DisplayFunctions->removeByKey($maneuverlist, ['created', 'modified']);
							}
						}

						$this->set('maneuverlist', $maneuverlist);
						$this->render("getmaneuvers");
					}

//	public function ajax_getWeaponInfo($id) {
//		if ($this->request->is('post')) {
//
//			$conditions = $this->request->data('Character');
//
//			$characterweapons = $this->Characterweapon->find('all', array(
//				'conditions' => array('id' => $id)
//			));
//			echo json_encode($characterweapons($id));
//		}
//		exit();
//	}

					public function getlevels($character_id, $main_id, $off_id) {
						$this->autoLayout = false;

						$mainleveltracking = $this->Characterweapon->find('all', array(
							'conditions' => array(
								'Characterweapon.character_id' => $character_id,
								'Characterweapon.id' => $main_id
							),
							'contain' => array(
								'Characterlevel'
							),
							'fields' => array(
								'Characterweapon.id'
							)
						));

						if ($mainleveltracking) {
							$mainleveltracking = $mainleveltracking[0]['Characterlevel'];
						}

						$offleveltracking = $this->Characterweapon->find('all', array(
							'conditions' => array(
								'Characterweapon.character_id' => $character_id,
								'Characterweapon.id' => $off_id
							),
							'contain' => array(
								'Characterlevel'
							),
							'fields' => array(
								'Characterweapon.id'
							)
						));

						if ($offleveltracking) {
							$offleveltracking = $offleveltracking[0]['Characterlevel'];
						}

						$mainlevels = array();
						foreach ($mainleveltracking as $key => $clevel) {
							$mainlevels[$clevel['id']] = $clevel['id'];
						}

						$offlevels = array();
						foreach ($offleveltracking as $key => $clevel) {
							$offlevels[$clevel['id']] = $clevel['id'];
						}

						$mainonly = array_diff_key($mainlevels, $offlevels);
						$offonly = array_diff_key($offlevels, $mainlevels);
						$both = array_intersect_key($mainlevels, $offlevels);

//		pr($mainonly);
//		pr($offonly);
//		pr($both);

						$mainonlyinfo = $this->Characterlevel->find('all', array(
							'conditions' => array(
								'Characterlevel.id' => $mainonly
							),
							'contain' => array(
								'Level'
							)
						));

						$offonlyinfo = $this->Characterlevel->find('all', array(
							'conditions' => array(
								'Characterlevel.id' => $offonly
							),
							'contain' => array(
								'Level'
							)
						));

						$bothinfo = $this->Characterlevel->find('all', array(
							'conditions' => array(
								'Characterlevel.id' => $both
							),
							'contain' => array(
								'Level'
							)
						));

//		pr($mainonlyinfo);
//		pr($offonlyinfo);
//		pr($bothinfo);

						$mainonlyhtml = $this->buildLevelHTML($mainonlyinfo);
						$offonlyhtml = $this->buildLevelHTML($offonlyinfo);
						$bothhtml = $this->buildLevelHTML($bothinfo);


//echo $mainonlyhtml;
//echo $offonlyhtml;
//echo $bothhtml;
//		$this->set(compact('mainweapon', 'offweapon', 'mainonlyhtml', 'offonlyhtml', 'bothhtml', 'characterinfo'));
						$this->set(compact('mainonlyhtml', 'offonlyhtml', 'bothhtml'));
					}

					function buildLevelHTML($info) {
						$html = "";
						foreach ($info as $level) {
							for ($ctr = 0; $ctr < $level['Characterlevel']['qty']; $ctr++) {
								$html .= "<div class='cl " . $level['Level']['uses'];
								$html .= " cl-" . strtolower($level['Level']['color']) . "'";
								$html .= " data-color='" . strtolower($level['Level']['color']) . "' data-hand='main'";
								$html .= " data-clevel='" . $level['Characterlevel']['id'] . "'>";
								$cluse = array();
								$cluse[] = '<b><i>' . $level['Characterlevel']['name'] . '</i></b>';
//				$cluse[] = $level['Level']['uses'];
								if ($cluse) {
									$html .= implode('<br>', $cluse);
								}
								$html .= "</div>";
							}
						}
						return $html;
					}

					public function setlevels_all_info() {
						$this->set('characterdata', $this->Character->find('all', array(
									'contain' => array(
										'Characterweapon' => array(
											'Weapon', 'Characterlevel' => array(
												'Level'
											)
										)
									)
						)));
					}

					public function testcode() {
						
					}

				}
				