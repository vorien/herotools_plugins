<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\Characterweapon;

/**
 * Characterweapons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 * @property \Cake\ORM\Association\BelongsTo $Weapons
 * @property \Cake\ORM\Association\BelongsToMany $Characterlevels
 */
class CharacterweaponsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('characterweapons');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Characters'
        ]);
        $this->belongsTo('Weapons', [
            'foreignKey' => 'weapon_id',
            'className' => 'Vorien/HeroCombat.Weapons'
        ]);
        $this->belongsToMany('Characterlevels', [
            'foreignKey' => 'characterweapon_id',
            'targetForeignKey' => 'characterlevel_id',
            'through' => 'Vorien/HeroCombat.CharacterlevelsCharacterweapons',
            'className' => 'Vorien/HeroCombat.Characterlevels'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('ocv_modifier')
            ->allowEmpty('ocv_modifier');

        $validator
            ->integer('dcv_modifier')
            ->allowEmpty('dcv_modifier');

        $validator
            ->numeric('damage_classes_modifier')
            ->allowEmpty('damage_classes_modifier');

        $validator
            ->integer('str_min_modifier')
            ->allowEmpty('str_min_modifier');

        $validator
            ->numeric('range_modifier')
            ->allowEmpty('range_modifier');

        $validator
            ->numeric('max_range_modifier')
            ->allowEmpty('max_range_modifier');

        $validator
            ->integer('offhand_offset')
            ->allowEmpty('offhand_offset');

        $validator
            ->integer('offhand_defense')
            ->allowEmpty('offhand_defense');

        $validator
            ->integer('multi_attack_offset')
            ->allowEmpty('multi_attack_offset');

        $validator
            ->boolean('weapon_element')
            ->allowEmpty('weapon_element');

        $validator
            ->allowEmpty('notes');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['character_id'], 'Characters'));
        $rules->add($rules->existsIn(['weapon_id'], 'Weapons'));
        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'herocombat';
    }
}
