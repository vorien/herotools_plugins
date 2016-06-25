<?php
namespace Vorien\NPCData\Model\Entity;

use Cake\ORM\Entity;

/**
 * Persona Entity.
 *
 * @property int $id
 * @property int $person_id
 * @property \Vorien\NPCData\Model\Entity\Person $person
 * @property int $agenda_id
 * @property \Vorien\NPCData\Model\Entity\Agenda $agenda
 * @property string $profession
 * @property string $employer
 * @property int $influence
 * @property int $wealth
 * @property string $picture
 * @property string $gender
 * @property int $generosity
 * @property int $decency
 * @property int $reliability
 * @property int $reserve
 * @property int $benevolence
 * @property int $restraint
 * @property int $moderation
 * @property int $stability
 * @property int $outlook
 * @property int $integrity
 * @property int $discipline
 * @property int $spirit
 * @property int $gregariousness
 * @property int $conformity
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\NPCData\Model\Entity\Note[] $notes
 * @property \Vorien\NPCData\Model\Entity\Archetype[] $archetypes
 * @property \Vorien\NPCData\Model\Entity\Flaw[] $flaws
 * @property \Vorien\NPCData\Model\Entity\Guild[] $guilds
 * @property \Vorien\NPCData\Model\Entity\Motivation[] $motivations
 * @property \Vorien\NPCData\Model\Entity\Quality[] $qualities
 * @property \Vorien\NPCData\Model\Entity\Quirk[] $quirks
 */
class Persona extends Entity
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
