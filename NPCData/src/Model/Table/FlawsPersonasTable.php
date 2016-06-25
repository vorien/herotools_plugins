<?php
namespace Vorien\NPCData\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\NPCData\Model\Entity\FlawsPersona;

/**
 * FlawsPersonas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Personas
 * @property \Cake\ORM\Association\BelongsTo $Flaws
 */
class FlawsPersonasTable extends Table
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

        $this->table('flaws_personas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Personas', [
            'foreignKey' => 'persona_id',
            'className' => 'Vorien/NPCData.Personas'
        ]);
        $this->belongsTo('Flaws', [
            'foreignKey' => 'flaw_id',
            'className' => 'Vorien/NPCData.Flaws'
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
            ->integer('severity')
            ->allowEmpty('severity');

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
        $rules->add($rules->existsIn(['flaw_id'], 'Flaws'));
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
