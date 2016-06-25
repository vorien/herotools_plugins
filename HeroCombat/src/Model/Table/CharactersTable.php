<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\Character;

/**
 * Characters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Gms
 * @property \Cake\ORM\Association\HasMany $Characterlevels
 * @property \Cake\ORM\Association\HasMany $Charactermaneuvers
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 * @property \Cake\ORM\Association\HasMany $Characterweapons
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

        $this->table('herocombat.characters');
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
        $this->hasMany('Characterlevels', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Characterlevels'
        ]);
        $this->hasMany('Charactermaneuvers', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Charactermaneuvers'
        ]);
        $this->hasMany('Characterprotections', [
            'foreignKey' => 'character_id',
            'className' => 'Vorien/HeroCombat.Characterprotections'
        ]);
        $this->hasMany('Characterweapons', [
            'foreignKey' => 'character_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
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
        return 'herocombat';
    }
}
