<?php
namespace Vorien\NPCData\Model\Entity;

use Cake\ORM\Entity;

/**
 * FlawsPersona Entity.
 *
 * @property int $id
 * @property int $persona_id
 * @property \Vorien\NPCData\Model\Entity\Persona $persona
 * @property int $flaw_id
 * @property \Vorien\NPCData\Model\Entity\Flaw $flaw
 * @property int $severity
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class FlawsPersona extends Entity
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
