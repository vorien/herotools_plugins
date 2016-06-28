<?php
namespace Vorien\HeroCSheet\Model\Entity;

use Cake\ORM\Entity;

/**
 * Charactersheet Entity.
 *
 * @property int $id
 * @property int $character_id
 * @property \Vorien\HeroCSheet\Model\Entity\Character $character
 * @property string $characterfile
 * @property string $mainfile
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
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
        'id' => false,
    ];
}
