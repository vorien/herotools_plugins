<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Armor Entity
 *
 * @property int $id
 * @property string $type
 * @property string $armor
 * @property int $r_pd
 * @property int $r_ed
 * @property int $training_penalty
 * @property string $ar_cost
 * @property float $weight
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\HeroCombat\Model\Entity\Armormaterial[] $armormaterials
 * @property \Vorien\HeroCombat\Model\Entity\Characterprotection[] $characterprotections
 */
class Armor extends Entity
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
