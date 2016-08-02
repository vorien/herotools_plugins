<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characterstats Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 * @property \Cake\ORM\Association\HasMany $Characterlevels
 * @property \Cake\ORM\Association\HasMany $Charactermaneuvers
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 * @property \Cake\ORM\Association\HasMany $Characterweapons
 *
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterstat findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharacterstatsTable extends Table
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

        $this->table('characterstats');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Characters'
        ]);
        $this->hasMany('Characterlevels', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Characterlevels'
        ]);
        $this->hasMany('Charactermaneuvers', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Charactermaneuvers'
        ]);
        $this->hasMany('Characterprotections', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Characterprotections'
        ]);
        $this->hasMany('Characterweapons', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Characterweapons'
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
        return 'herocombat';
    }
}
