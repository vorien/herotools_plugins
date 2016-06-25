<?php
namespace Vorien\HeroCombat\Model\Entity;

use Cake\ORM\Entity;

/**
 * Location Entity.
 *
 * @property int $id
 * @property int $target_id
 * @property \Vorien\HeroCombat\Model\Entity\Target $target
 * @property int $roll
 * @property string $location
 * @property string $sublocation
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Vorien\HeroCombat\Model\Entity\Characterprotection[] $characterprotections
 * @property \Vorien\HeroCombat\Model\Entity\Coveringlocation[] $coveringlocations
 */
class Location extends Entity
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

		protected function _getLocationData() {
		return $this->
				_properties['roll'] . ' - ' .
				$this->_properties['location'] .
				(!empty($this->_properties['sublocation']) ? ' (' . $this->_properties['sublocation'] . ')' : '');
	}


}
