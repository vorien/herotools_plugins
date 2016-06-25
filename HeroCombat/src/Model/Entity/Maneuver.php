<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Maneuver Entity.
 *
 * @property int $id
 * @property int $sort_order
 * @property string $effect
 * @property string $type
 * @property string $maneuver
 * @property float $phase
 * @property string $ocv_action
 * @property float $ocv_amt
 * @property string $dcv_action
 * @property float $dcv_amt
 * @property string $dmg_action
 * @property float $dmg_amt
 * @property string $rng_action
 * @property float $rng_amt
 * @property string $str_action
 * @property float $str_amt
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\HeroCombat\Model\Entity\Charactermaneuver[] $charactermaneuvers
 */
class Maneuver extends Entity
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
