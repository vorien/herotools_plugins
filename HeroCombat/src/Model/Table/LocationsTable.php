<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Targets
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 * @property \Cake\ORM\Association\HasMany $Coveringlocations
 *
 * @method \Vorien\HeroCombat\Model\Entity\Location get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Location findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LocationsTable extends Table
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

        $this->table('locations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Targets', [
            'foreignKey' => 'target_id',
            'joinType' => 'INNER',
            'className' => 'Vorien/HeroCombat.Targets'
        ]);
        $this->hasMany('Characterprotections', [
            'foreignKey' => 'location_id',
            'className' => 'Vorien/HeroCombat.Characterprotections'
        ]);
        $this->hasMany('Coveringlocations', [
            'foreignKey' => 'location_id',
            'className' => 'Vorien/HeroCombat.Coveringlocations'
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
            ->integer('roll')
            ->allowEmpty('roll');

        $validator
            ->allowEmpty('location');

        $validator
            ->allowEmpty('sublocation');

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
        $rules->add($rules->existsIn(['target_id'], 'Targets'));

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
