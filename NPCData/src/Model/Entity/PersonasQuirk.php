<?php
namespace Vorien\NPCData\Model\Entity;

use Cake\ORM\Entity;

/**
 * PersonasQuirk Entity.
 *
 * @property int $id
 * @property int $persona_id
 * @property \Vorien\NPCData\Model\Entity\Persona $persona
 * @property int $quirk_id
 * @property \Vorien\NPCData\Model\Entity\Quirk $quirk
 * @property int $severity
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class PersonasQuirk extends Entity
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
