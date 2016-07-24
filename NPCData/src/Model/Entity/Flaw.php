<?php

namespace Vorien\NPCData\Model\Entity;

use Cake\ORM\Entity;

/**
 * Flaw Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\NPCData\Model\Entity\Persona[] $personas
 */
class Flaw extends Entity {

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

	protected function _getSelectValue() {
		return $this->_properties['name'] . ':     ' . $this->_properties['description'];
	}

}
