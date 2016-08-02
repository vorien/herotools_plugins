<?php
namespace Vorien\HeroCSheet\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Charactersheets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 *
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet get($primaryKey, $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCSheet\Model\Entity\Charactersheet findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharactersheetsTable extends Table
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

        $this->table('charactersheets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCSheet.Characters'
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
            ->allowEmpty('characterfile');

        $validator
            ->allowEmpty('mainfile');

        $validator
            ->allowEmpty('basic_configuration');

        $validator
            ->allowEmpty('character_info');

        $validator
            ->allowEmpty('characteristics');

        $validator
            ->allowEmpty('skills');

        $validator
            ->allowEmpty('perks');

        $validator
            ->allowEmpty('talents');

        $validator
            ->allowEmpty('powers');

        $validator
            ->allowEmpty('disadvantages');

        $validator
            ->allowEmpty('equipment');

        $validator
            ->allowEmpty('skill_enhancers');

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

        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'herocsheet';
    }
}
