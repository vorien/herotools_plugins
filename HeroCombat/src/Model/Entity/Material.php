<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Material Entity
 *
 * @property int $id
 * @property string $material
 * @property string $manufacture
 * @property string $option
 * @property int $r_pd
 * @property int $r_ed
 * @property float $weightmultiplier
 * @property float $grade
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\HeroCombat\Model\Entity\Armormaterial[] $armormaterials
 * @property \Vorien\HeroCombat\Model\Entity\Characterprotection[] $characterprotections
 */
class Material extends Entity
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
