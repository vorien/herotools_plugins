<?php
namespace Vorien\Dashboard\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Userdata
 * @property \Cake\ORM\Association\BelongsTo $Gms
 *
 * @method \Vorien\Dashboard\Model\Entity\Character get($primaryKey, $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character newEntity($data = null, array $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character[] newEntities(array $data, array $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\Dashboard\Model\Entity\Character findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharactersTable extends Table
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

        $this->table('characters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Userdata', [
            'foreignKey' => 'userdata_id',
            'className' => 'Vorien/Dashboard.Userdata'
        ]);
        $this->belongsTo('Gms', [
            'foreignKey' => 'gm_id',
            'className' => 'Vorien/Dashboard.Userdata'
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
            ->allowEmpty('player');

        $validator
            ->integer('str')
            ->allowEmpty('str');

        $validator
            ->integer('con')
            ->allowEmpty('con');

        $validator
            ->integer('ocv')
            ->allowEmpty('ocv');

        $validator
            ->integer('dcv')
            ->allowEmpty('dcv');

        $validator
            ->integer('omcv')
            ->allowEmpty('omcv');

        $validator
            ->integer('dmcv')
            ->allowEmpty('dmcv');

        $validator
            ->integer('ma_dc')
            ->allowEmpty('ma_dc');

        $validator
            ->integer('n_pd')
            ->allowEmpty('n_pd');

        $validator
            ->integer('n_ed')
            ->allowEmpty('n_ed');

        $validator
            ->integer('r_pd')
            ->allowEmpty('r_pd');

        $validator
            ->integer('r_ed')
            ->allowEmpty('r_ed');

        $validator
            ->integer('body')
            ->allowEmpty('body');

        $validator
            ->integer('stun')
            ->allowEmpty('stun');

        $validator
            ->integer('endurance')
            ->allowEmpty('endurance');

        $validator
            ->integer('recovery')
            ->allowEmpty('recovery');

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
        $rules->add($rules->existsIn(['userdata_id'], 'Userdata'));
        $rules->add($rules->existsIn(['gm_id'], 'Gms'));

        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'herodashboard';
    }
}
