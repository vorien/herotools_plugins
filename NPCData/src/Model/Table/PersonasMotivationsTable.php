<?php
namespace Vorien\NPCData\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\NPCData\Model\Entity\PersonasMotivation;

/**
 * PersonasMotivations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Personas
 * @property \Cake\ORM\Association\BelongsTo $Motivations
 */
class PersonasMotivationsTable extends Table
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

        $this->table('personas_motivations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Personas', [
            'foreignKey' => 'persona_id',
            'className' => 'Vorien/NPCData.Personas'
        ]);
        $this->belongsTo('Motivations', [
            'foreignKey' => 'motivation_id',
            'className' => 'Vorien/NPCData.Motivations'
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
            ->integer('priority')
            ->allowEmpty('priority');

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
        $rules->add($rules->existsIn(['persona_id'], 'Personas'));
        $rules->add($rules->existsIn(['motivation_id'], 'Motivations'));
        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'npcdata';
    }
}
