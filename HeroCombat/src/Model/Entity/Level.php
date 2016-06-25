<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Level Entity.
 *
 * @property int $id
 * @property string $type
 * @property int $cost
 * @property string $color
 * @property string $uses
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\HeroCombat\Model\Entity\Characterlevel[] $characterlevels
 */
class Level extends Entity
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
