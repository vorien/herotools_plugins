<?php
namespace Vorien\Dashboard\Model\Entity;

use Cake\ORM\Entity;

/**
 * Userdata Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \Vorien\Dashboard\Model\Entity\User $user
 * @property bool $is_gm
 * @property bool $is_admin
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Userdata extends Entity
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
