<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\Target;

/**
 * Targets Model
 *
 * @property \Cake\ORM\Association\HasMany $Locations
 */
class TargetsTable extends Table
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

        $this->table('targets');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Locations', [
            'foreignKey' => 'target_id',
            'className' => 'Vorien/HeroCombat.Locations'
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
            ->allowEmpty('roll');

        $validator
            ->allowEmpty('location');

        $validator
            ->integer('penalty')
            ->allowEmpty('penalty');

        $validator
            ->numeric('stunx')
            ->allowEmpty('stunx');

        $validator
            ->numeric('bodyx')
            ->allowEmpty('bodyx');

        $validator
            ->numeric('nstun')
            ->allowEmpty('nstun');

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
