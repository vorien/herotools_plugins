<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\Weapon;

/**
 * Weapons Model
 *
 * @property \Cake\ORM\Association\HasMany $Characterweapons
 */
class WeaponsTable extends Table
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

        $this->table('weapons');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Characterweapons', [
            'foreignKey' => 'weapon_id',
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
            ->allowEmpty('weapon');

        $validator
            ->allowEmpty('type');

        $validator
            ->numeric('str_overage')
            ->allowEmpty('str_overage');

        $validator
            ->numeric('str_adds_damage')
            ->allowEmpty('str_adds_damage');

        $validator
            ->numeric('ocv')
            ->allowEmpty('ocv');

        $validator
            ->numeric('dcv')
            ->allowEmpty('dcv');

        $validator
            ->numeric('damage_classes')
            ->allowEmpty('damage_classes');

        $validator
            ->allowEmpty('damage_type');

        $validator
            ->allowEmpty('damage_effect');

        $validator
            ->numeric('stunx')
            ->allowEmpty('stunx');

        $validator
            ->numeric('str_min')
            ->allowEmpty('str_min');

        $validator
            ->numeric('body')
            ->allowEmpty('body');

        $validator
            ->numeric('def')
            ->allowEmpty('def');

        $validator
            ->numeric('mass')
            ->allowEmpty('mass');

        $validator
            ->allowEmpty('ar_cost');

        $validator
            ->allowEmpty('length');

        $validator
            ->numeric('hands')
            ->allowEmpty('hands');

        $validator
            ->allowEmpty('shots');

        $validator
            ->boolean('thrown')
            ->allowEmpty('thrown');

        $validator
            ->numeric('rmod')
            ->allowEmpty('rmod');

        $validator
            ->allowEmpty('max_range');

        $validator
            ->boolean('concentration')
            ->allowEmpty('concentration');

        $validator
            ->numeric('advantages')
            ->allowEmpty('advantages');

        $validator
            ->allowEmpty('notes');

        $validator
            ->numeric('str_overage_old')
            ->allowEmpty('str_overage_old');

        return $validator;
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
