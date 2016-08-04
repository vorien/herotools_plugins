<?php

namespace Vorien\HeroCombat\Controller;

use Vorien\HeroCombat\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Plugin;
use Cake\Event\Event;

/**
 * CakePHP CombatController
 * @author Michael
 */
class HerocombatController extends AppController {

	public function initialize() {
		parent::initialize();
		$this->loadComponent('Vorien/Dashboard.CharacterOwnership');
		$this->loadComponent('Vorien/Dashboard.DisplayFunctions');
		$this->loadComponent('Vorien/HeroCombat.Ownership');
	}

	public function beforeRender(Event $event) {
		parent::beforeRender($event);
		$this->viewBuilder()->helpers(['Vorien/Dashboard.PageBuild']);
	}

	public function index($characterstat_id) {
//		debug($this->Ownership->user());
//		exit;
		//Make sure the current user should have access to the selected character
		$this->CharacterOwnership->checkCharacterOwnership($characterstat_id);

		//Set the active character in the session for faster reference
//		$this->ActiveCharacter->setActiveCharacter($characterstat_id);

		$ajax_root = '/herocombat/';
		$armorlocationinfo = $this->getArmorLocationInfo($characterstat_id);
		$json_armorlocationinfo = json_encode($armorlocationinfo);

		$targetinfo = $this->getTargetInfo();
		$json_targetinfo = json_encode($targetinfo);

		$locationinfo = $this->getLocationInfo();
		$json_locationinfo = json_encode($locationinfo);

		$maneuvers_standard = $this->getManeuverList("Standard");
		$maneuvers_optional = $this->getManeuverList("Optional");

		$characterinfo = $this->getCharacterInfo($characterstat_id);
		$json_characterinfo = json_encode($characterinfo);

		$weapons = $this->getAllWeaponInfo($characterstat_id);
		$json_weapons = json_encode($weapons);

		$leveltracking = $this->getLevelTrackingArray($characterstat_id);
		$json_leveltracking = json_encode($leveltracking);

		$starting_weapon_id = $this->getUnarmedCharacterWeapon($characterstat_id);


//		debug($weapons);
//		debug($leveltracking);

		$this->set('title_for_layout', 'Combat Calculator');

		$this->set(compact('ajax_root', 'characterinfo', 'json_characterinfo', 'locationinfo', 'json_targetinfo', 'targetinfo', 'json_locationinfo', 'json_weapons', 'maneuvers_standard', 'maneuvers_optional', 'weapons', 'starting_weapon_id', 'armorlocationinfo', 'json_armorlocationinfo', 'leveltracking', 'json_leveltracking'));
	}

	public function getArmorLocationInfo($characterstat_id) {
		if (!$characterstat_id) {
			return [];
		}
		$data = TableRegistry::get('Vorien/HeroCombat.Characterprotections');
		$query = $data->find();
		$query->hydrate(false);
		$query->contain([
			'Locations' => function ($q) {
				return $q->select(['roll', 'location', 'sublocation']);
			},
					'Armors' => function ($q) {
				return $q->select(['armor', 'type', 'r_pd', 'r_ed']);
			},
					'Materials' => function ($q) {
				return $q->select(['material', 'manufacture', 'option', 'r_pd', 'r_ed']);
			}
				]);
				$query->where([
					'Characterprotections.characterstat_id' => $characterstat_id,
					'Characterprotections.active' => true
				]);
				$armorlocationinfo = $query->all()->toArray();

				$armordata = [];
				foreach ($armorlocationinfo as $armorlocation) {
					$armordata[$armorlocation['location']['roll']] = [
						'id' => $armorlocation['id'],
						'active' => $armorlocation['active'],
						'character_id' => $armorlocation['characterstat_id'],
						'location_id' => $armorlocation['location_id'],
						'covering_id' => $armorlocation['covering_id'],
						'armor_id' => $armorlocation['armor_id'],
						'material_id' => $armorlocation['material_id'],
						'name' => $armorlocation['name'],
						'n_pd' => $armorlocation['n_pd_modifier'] + $armorlocation['material']['r_pd'] + $armorlocation['armor']['r_pd'],
						'n_ed' => $armorlocation['n_ed_modifier'] + $armorlocation['material']['r_ed'] + $armorlocation['armor']['r_ed'],
						'r_pd' => $armorlocation['r_pd_modifier'] + $armorlocation['material']['r_pd'] + $armorlocation['armor']['r_pd'],
						'r_ed' => $armorlocation['n_ed_modifier'] + $armorlocation['material']['r_ed'] + $armorlocation['armor']['r_ed'],
						'stealth_penalty' => $armorlocation['stealth_penalty'],
						'weight_modifier' => $armorlocation['weight_modifier'],
						'training_penalty_offset' => $armorlocation['training_penalty_offset'],
						'normal_dr' => $armorlocation['normal_dr'],
						'killing_dr' => $armorlocation['killing_dr'],
						'notes' => $armorlocation['notes'],
						'material' => [
							'material' => $armorlocation['material']['material'],
							'manufacture' => $armorlocation['material']['manufacture'],
							'option' => $armorlocation['material']['option'],
						],
						'armor' => [
							'armor' => $armorlocation['armor']['armor'],
							'type' => $armorlocation['armor']['type'],
						],
						'location' => [
							'roll' => $armorlocation['location']['roll'],
							'location' => $armorlocation['location']['location'],
							'sublocation' => $armorlocation['location']['sublocation'],
						]
					];
				}
				ksort($armordata);
				return $armordata;
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
				$locationinfo = $query->all()->toArray();
				$this->DisplayFunctions->removeByKey($maneuverinfo, ['$locationinfo', 'modified']);

				$locationdata = [];
				foreach ($locationinfo as $location) {
					$locationdata[$location['roll']] = $location;
					$locationdata[$location['roll']]['locationdata'] = $location['roll'] . ' - ' . $location['location'] . (!empty($location['sublocation']) ? ' (' . $location['sublocation'] . ')' : '');
				}
				return $locationdata;
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

			public function getCharacterInfo($characterstat_id = null) {
				if (!$characterstat_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterstats');
				$query = $data->find();
				$query->hydrate(false);
				$query->where(['Characterstats.id' => $characterstat_id]);
				$characterinfo = $query->first();
				$this->DisplayFunctions->removeByKey($characterinfo, ['created', 'modified']);
				return $characterinfo;
			}

			public function getAllWeaponInfo($characterstat_id) {
				if (!$characterstat_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
				$query = $data->find();
				$query->hydrate(false);
				$query->contain(['Weapons']);
				$query->where(['Characterweapons.characterstat_id' => $characterstat_id]);
				$characterweapons = $query->all()->toArray();

				$weapondata = [];
				foreach ($characterweapons as $characterweapon) {
					$weapondata[$characterweapon['id']] = [
						'id' => $characterweapon['id'],
						'character_id' => $characterweapon['characterstat_id'],
						'weapon_id' => $characterweapon['weapon_id'],
						'name' => $characterweapon['name'],
						'ocv' => $characterweapon['ocv_modifier'] + $characterweapon['weapon']['ocv'],
						'dcv' => $characterweapon['dcv_modifier'] + $characterweapon['weapon']['dcv'],
						'damage_classes' => $characterweapon['damage_classes_modifier'] + $characterweapon['weapon']['damage_classes'],
						'str_min' => $characterweapon['str_min_modifier'] + $characterweapon['weapon']['str_min'],
						'range_modifier' => $characterweapon['range_modifier'] + $characterweapon['weapon']['rmod'],
						'max_range' => $characterweapon['max_range_modifier'] + $characterweapon['weapon']['max_range'],
						'offhand_offset' => $characterweapon['offhand_offset'],
						'offhand_defense' => $characterweapon['offhand_defense'],
						'multi_attack_offset' => $characterweapon['multi_attack_offset'],
						'weapon_element' => $characterweapon['weapon_element'],
						'notes' => $characterweapon['notes'] . $characterweapon['weapon']['notes'],
						'weapon' => [
							'weapon' => $characterweapon['weapon']['weapon'],
							'type' => $characterweapon['weapon']['type'],
							'str_overage' => $characterweapon['weapon']['str_overage'],
							'str_adds_damage' => $characterweapon['weapon']['str_adds_damage'],
							'damage_type' => $characterweapon['weapon']['damage_type'],
							'damage_effect' => $characterweapon['weapon']['damage_effect'],
							'stunx' => $characterweapon['weapon']['stunx'],
							'body' => $characterweapon['weapon']['body'],
							'def' => $characterweapon['weapon']['def'],
							'mass' => $characterweapon['weapon']['mass'],
							'ar_cost' => $characterweapon['weapon']['ar_cost'],
							'length' => $characterweapon['weapon']['length'],
							'hands' => $characterweapon['weapon']['hands'],
							'shots' => $characterweapon['weapon']['shots'],
							'thrown' => $characterweapon['weapon']['thrown'],
							'concentration' => $characterweapon['weapon']['concentration'],
							'advantages' => $characterweapon['weapon']['advantages']
						]
					];
				}
				return $weapondata;
			}

			public function getLevelTrackingArray($characterstat_id) {
				if (!$characterstat_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterlevels');
				$query = $data->find();
				$query->hydrate(false);
				$query->contain([
					'Levels',
					'Characterweapons'
				]);
				$query->where(['Characterlevels.characterstat_id' => $characterstat_id]);
				$leveltrackingarray = $query->all()->toArray();

				$explodedlevels = [];
				foreach ($leveltrackingarray as $lta_key => $level) {
					$weaponarray = [];
					foreach ($level['characterweapons'] as $cwvalue) {
						$weaponarray[] = intval($cwvalue['id']);
					}
					for ($ctr = 0; $ctr < $level['qty']; $ctr++) {
						$levelarray = [
							// Create a unique id for each exploded level
							'id' => (($lta_key + 1) * 100) + ($ctr + 1),
							'name' => $level['name'],
							'type' => $level['level']['type'],
							'claimed' => false,
							'cost' => intval($level['level']['cost']),
							'color' => $level['level']['color'],
							'weapons' => $weaponarray
						];
						$explodedlevels[] = $levelarray;
					}
				}
				return $explodedlevels;

//				$all_levels = $this->Characterlevel->find('all', array(
//					'conditions' => array(
//						'Characterlevel.characterstat_id' => $characterstat_id
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
//
//				foreach ($leveltrackingarray as $ltakey => $ltavalue) {
//					$leveltrackingarray[$ltakey]['id'] = $ltakey;
//				}
//
//				return($leveltrackingarray);
			}

			public function getUnarmedCharacterWeapon($characterstat_id) {
				if (!$characterstat_id) {
					return [];
				}
				$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
				$query = $data->find();
				$query->hydrate(false);
				$query->select('id');
				$query->where([
					'Characterweapons.characterstat_id' => $characterstat_id,
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

			public function listweapons($characterstat_id) {
				$weaponlist = $this->Characterweapon->find('list', array(
					'fields' => array('Characterweapon.name'),
					'contain' => array('Weapon'),
					'order' => array('Weapon.type'),
					'conditions' => array('character_id' => $characterstat_id)
				));

				return $weaponlist;
			}

			public function ajax_getcharacterinfo($characterstat_id) {
				$this->autoRender = false;
				echo json_encode($this->getcharacterinfo($characterstat_id));
			}

			public function ajax_getweapondata($characterstat_id, $id) {
				$this->autoRender = false;
				echo json_encode($this->getWeaponData($characterstat_id, $id));
			}

			public function getWeaponData($characterstat_id, $id) {
//		$weapondata = $this->Characterweapon->find('all');
				$weapondata = $this->Characterweapon->find('first', array(
					'conditions' => array(
						'Characterweapon.characterstat_id' => $characterstat_id,
						'Characterweapon.id' => $id
					),
					'contain' => array(
						'Weapon'
					)
				));
				return $this->UTF->arrayToUTF8($weapondata);
			}

			public function getmartialmaneuvers($characterstat_id = null, $mainid = 0) {
				$this->viewBuilder()->autoLayout(false);
				$maneuverlist = array();

				if ($characterstat_id) {

					$data = TableRegistry::get('Vorien/HeroCombat.Characterweapons');
					$query = $data->find();
					$query->hydrate(false);
					$query->where([
						'Characterweapons.characterstat_id' => $characterstat_id,
						'Characterweapons.id' => $mainid,
						'Characterweapons.weapon_element' => 1
					]);
					$weaponelements = $query->count();

					if ($weaponelements > 0) {
						$data = TableRegistry::get('Vorien/HeroCombat.Charactermaneuvers');
						$query = $data->find();
						$query->hydrate(false);
						$query->where(['Charactermaneuvers.characterstat_id' => $characterstat_id]);
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

					public function getlevels($characterstat_id, $main_id, $off_id) {
						$this->autoLayout = false;

						$mainleveltracking = $this->Characterweapon->find('all', array(
							'conditions' => array(
								'Characterweapon.characterstat_id' => $characterstat_id,
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
								'Characterweapon.characterstat_id' => $characterstat_id,
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

//	public function getArmorLocationInfo($characterstat_id) {
//		if (!$characterstat_id) {
//			return [];
//		}
//		$data = TableRegistry::get('Vorien/HeroCombat.Characterprotections');
//		$query = $data->find();
//		$query->hydrate(false);
//		$query->contain([
//			'Locations' => function ($q) {
//				return $q->select(['roll', 'location', 'sublocation'])
//								->formatResults(function ($locations) {
//									return $locations->map(function ($location) {
//												$location['locationdata'] = $location['roll'] . ' - ' . $location['location'] . (!empty($location['sublocation']) ? ' (' . $location['sublocation'] . ')' : '');
//												return $location;
//											});
//								});
////				return $q->select(['roll', 'location', 'sublocation']);
//			},
//					'Armors' => function ($q) {
//				return $q->select(['armor', 'type', 'r_pd', 'r_ed'])
//								->formatResults(function ($armors) {
//									return $armors->map(function ($armor) {
//												$armor['armordata'] = $armor['armor'] . ' (' . $armor['type'] . ')';
//												return $armor;
//											});
//								});
//			},
//					'Materials' => function ($q) {
//				return $q->select(['material', 'manufacture', 'option', 'r_pd', 'r_ed'])
//								->formatResults(function ($materials) {
//									return $materials->map(function ($material) {
//												$material['materialdata'] = $material['material'] . ' - ' .
//														(!empty($material['manufacture']) ? ' (' . $material['manufacture'] .
//																(!empty($material['option']) ? ' / ' . $material['option'] : '') .
//																')' : '');
//												return $material;
//											});
//								});
//			}
//				]);
//				$query->where([
//					'Characterprotections.characterstat_id' => $characterstat_id,
//					'Characterprotections.active' => true
//				]);
//				$armorlocationinfo = $query->all()->toArray();
//				$this->DisplayFunctions->removeByKey($armorlocationinfo, ['created', 'modified']);
//				return $armorlocationinfo;
//
////				$return = [];
////				foreach ($armorlocationinfo as $armor) {
////					$return[$value['Location']['roll']] = $value[0];
////					$return[$value['Location']['roll']]['armor'] = $value['Armor']['armor'];
////					$return[$value['Location']['roll']]['material'] = $value['Material']['material'];
////					$return[$value['Location']['roll']]['armor'] = $value['Armor']['armor'];
////					$return[$value['Location']['roll']]['r_pd'] = max(0, $return[$value['Location']['roll']]['r_pd']);
////					$return[$value['Location']['roll']]['r_ed'] = max(0, $return[$value['Location']['roll']]['r_ed']);
////				}
////				return $return;
//			}
				}
				