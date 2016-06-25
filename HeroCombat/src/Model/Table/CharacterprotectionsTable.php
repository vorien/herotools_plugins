<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\Characterprotection;

/**
 * Characterprotections Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 * @property \Cake\ORM\Association\BelongsTo $Locations
 * @property \Cake\ORM\Association\BelongsTo $Coverings
 * @property \Cake\ORM\Association\BelongsTo $Armors
 * @property \Cake\ORM\Association\BelongsTo $Materials
 */
class CharacterprotectionsTable extends Table
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

        $this->table('characterprotections');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Characters'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'className' => 'Vorien/HeroCombat.Locations'
        ]);
        $this->belongsTo('Coverings', [
            'foreignKey' => 'covering_id',
            'className' => 'Vorien/HeroCombat.Coverings'
        ]);
        $this->belongsTo('Armors', [
            'foreignKey' => 'armor_id',
            'className' => 'Vorien/HeroCombat.Armors'
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
            'className' => 'Vorien/HeroCombat.Materials'
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
            ->boolean('active')
            ->allowEmpty('active');

        $validator
            ->allowEmpty('name');

        $validator
            ->integer('n_pd_modifier')
            ->allowEmpty('n_pd_modifier');

        $validator
            ->integer('n_ed_modifier')
            ->allowEmpty('n_ed_modifier');

        $validator
            ->integer('r_pd_modifiers')
            ->allowEmpty('r_pd_modifiers');

        $validator
            ->integer('r_ed_modifiers')
            ->allowEmpty('r_ed_modifiers');

        $validator
            ->integer('stealth_penalty')
            ->allowEmpty('stealth_penalty');

        $validator
            ->numeric('weight_modifier')
            ->allowEmpty('weight_modifier');

        $validator
            ->integer('training_penalty_offset')
            ->allowEmpty('training_penalty_offset');

        $validator
            ->numeric('normal_dr')
            ->allowEmpty('normal_dr');

        $validator
            ->numeric('killing_dr')
            ->allowEmpty('killing_dr');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['covering_id'], 'Coverings'));
        $rules->add($rules->existsIn(['armor_id'], 'Armors'));
        $rules->add($rules->existsIn(['material_id'], 'Materials'));
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
