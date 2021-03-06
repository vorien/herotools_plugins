<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Armormaterial Entity.
 *
 * @property int $id
 * @property int $armor_id
 * @property \Vorien\HeroCombat\Model\Entity\Armor $armor
 * @property int $material_id
 * @property \Vorien\HeroCombat\Model\Entity\Material $material
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Armormaterial extends Entity
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
