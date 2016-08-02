<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Characterstat Entity
 *
 * @property int $id
 * @property int $character_id
 * @property int $str
 * @property int $con
 * @property int $ocv
 * @property int $dcv
 * @property int $omcv
 * @property int $dmcv
 * @property int $ma_dc
 * @property int $n_pd
 * @property int $n_ed
 * @property int $r_pd
 * @property int $r_ed
 * @property int $body
 * @property int $stun
 * @property int $endurance
 * @property int $recovery
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\HeroCombat\Model\Entity\Character $character
 * @property \Vorien\HeroCombat\Model\Entity\Characterlevel[] $characterlevels
 * @property \Vorien\HeroCombat\Model\Entity\Charactermaneuver[] $charactermaneuvers
 * @property \Vorien\HeroCombat\Model\Entity\Characterprotection[] $characterprotections
 * @property \Vorien\HeroCombat\Model\Entity\Characterweapon[] $characterweapons
 */
class Characterstat extends Entity
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
