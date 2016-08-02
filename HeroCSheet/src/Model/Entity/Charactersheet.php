<?php
namespace Vorien\HeroCSheet\Model\Entity;

use Cake\ORM\Entity;

/**
 * Charactersheet Entity
 *
 * @property int $id
 * @property int $character_id
 * @property string $characterfile
 * @property string $mainfile
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $basic_configuration
 * @property string $character_info
 * @property string $characteristics
 * @property string $skills
 * @property string $perks
 * @property string $talents
 * @property string $powers
 * @property string $disadvantages
 * @property string $equipment
 * @property string $skill_enhancers
 *
 * @property \Vorien\HeroCSheet\Model\Entity\Character $character
 */
class Charactersheet extends Entity
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
