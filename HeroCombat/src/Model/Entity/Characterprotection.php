<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Characterprotection Entity.
 *
 * @property int $id
 * @property bool $active
 * @property int $character_id
 * @property \Vorien\HeroCombat\Model\Entity\Character $character
 * @property int $location_id
 * @property \Vorien\HeroCombat\Model\Entity\Location $location
 * @property int $covering_id
 * @property \Vorien\HeroCombat\Model\Entity\Covering $covering
 * @property int $armor_id
 * @property \Vorien\HeroCombat\Model\Entity\Armor $armor
 * @property int $material_id
 * @property \Vorien\HeroCombat\Model\Entity\Material $material
 * @property string $name
 * @property int $n_pd_modifier
 * @property int $n_ed_modifier
 * @property int $r_pd_modifiers
 * @property int $r_ed_modifiers
 * @property int $stealth_penalty
 * @property float $weight_modifier
 * @property int $training_penalty_offset
 * @property float $normal_dr
 * @property float $killing_dr
 * @property string $notes
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
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
        'id' => false,
    ];
}
