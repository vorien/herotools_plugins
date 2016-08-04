<?php
namespace Vorien\Dashboard\Model\Entity;

use Cake\ORM\Entity;

/**
 * Character Entity
 *
 * @property int $id
 * @property string $name
 * @property string $player
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
 * @property int $userdata_id
 * @property int $gm_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\Dashboard\Model\Entity\Userdata $userdata
 * @property \Vorien\Dashboard\Model\Entity\Gm $gm
 */
class Character extends Entity
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
