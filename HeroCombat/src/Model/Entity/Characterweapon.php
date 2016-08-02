<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Characterweapon Entity
 *
 * @property int $id
 * @property int $characterstat_id
 * @property int $weapon_id
 * @property string $name
 * @property int $ocv_modifier
 * @property int $dcv_modifier
 * @property float $damage_classes_modifier
 * @property int $str_min_modifier
 * @property float $range_modifier
 * @property float $max_range_modifier
 * @property int $offhand_offset
 * @property int $offhand_defense
 * @property int $multi_attack_offset
 * @property bool $weapon_element
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\HeroCombat\Model\Entity\Characterstat $characterstat
 * @property \Vorien\HeroCombat\Model\Entity\Weapon $weapon
 * @property \Vorien\HeroCombat\Model\Entity\Characterlevel[] $characterlevels
 */
class Characterweapon extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
