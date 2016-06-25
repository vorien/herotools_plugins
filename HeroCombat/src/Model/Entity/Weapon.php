<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Weapon Entity.
 *
 * @property int $id
 * @property string $weapon
 * @property string $type
 * @property float $str_overage
 * @property float $str_adds_damage
 * @property float $ocv
 * @property float $dcv
 * @property float $damage_classes
 * @property string $damage_type
 * @property string $damage_effect
 * @property float $stunx
 * @property float $str_min
 * @property float $body
 * @property float $def
 * @property float $mass
 * @property string $ar_cost
 * @property string $length
 * @property float $hands
 * @property string $shots
 * @property bool $thrown
 * @property float $rmod
 * @property string $max_range
 * @property bool $concentration
 * @property float $advantages
 * @property string $notes
 * @property float $str_overage_old
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\HeroCombat\Model\Entity\Characterweapon[] $characterweapons
 */
class Weapon extends Entity
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
        'id' => false,
    ];
}
