<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Maneuvers Model
 *
 * @property \Cake\ORM\Association\HasMany $Charactermaneuvers
 *
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Maneuver findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ManeuversTable extends Table
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

        $this->table('maneuvers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Charactermaneuvers', [
            'foreignKey' => 'maneuver_id',
            'className' => 'Vorien/HeroCombat.Charactermaneuvers'
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
            ->integer('sort_order')
            ->allowEmpty('sort_order');

        $validator
            ->allowEmpty('effect');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('maneuver');

        $validator
            ->numeric('phase')
            ->allowEmpty('phase');

        $validator
            ->allowEmpty('ocv_action');

        $validator
            ->numeric('ocv_amt')
            ->allowEmpty('ocv_amt');

        $validator
            ->allowEmpty('dcv_action');

        $validator
            ->numeric('dcv_amt')
            ->allowEmpty('dcv_amt');

        $validator
            ->allowEmpty('dmg_action');

        $validator
            ->numeric('dmg_amt')
            ->allowEmpty('dmg_amt');

        $validator
            ->allowEmpty('rng_action');

        $validator
            ->numeric('rng_amt')
            ->allowEmpty('rng_amt');

        $validator
            ->allowEmpty('str_action');

        $validator
            ->numeric('str_amt')
            ->allowEmpty('str_amt');

        $validator
            ->allowEmpty('notes');

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
