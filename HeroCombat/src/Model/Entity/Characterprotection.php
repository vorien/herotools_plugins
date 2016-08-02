<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Characterprotection Entity
 *
 * @property int $id
 * @property bool $active
 * @property int $characterstat_id
 * @property int $location_id
 * @property int $covering_id
 * @property int $armor_id
 * @property int $material_id
 * @property string $name
 * @property int $n_pd_modifier
 * @property int $n_ed_modifier
 * @property int $r_pd_modifier
 * @property int $r_ed_modifier
 * @property int $stealth_penalty
 * @property float $weight_modifier
 * @property int $training_penalty_offset
 * @property float $normal_dr
 * @property float $killing_dr
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \Vorien\HeroCombat\Model\Entity\Characterstat $characterstat
 * @property \Vorien\HeroCombat\Model\Entity\Location $location
 * @property \Vorien\HeroCombat\Model\Entity\Covering $covering
 * @property \Vorien\HeroCombat\Model\Entity\Armor $armor
 * @property \Vorien\HeroCombat\Model\Entity\Material $material
 */
class Characterprotection extends Entity
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
