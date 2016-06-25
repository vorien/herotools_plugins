<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Charactermaneuver Entity.
 *
 * @property int $id
 * @property int $character_id
 * @property \Vorien\HeroCombat\Model\Entity\Character $character
 * @property int $maneuver_id
 * @property \Vorien\HeroCombat\Model\Entity\Maneuver $maneuver
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Charactermaneuver extends Entity
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
