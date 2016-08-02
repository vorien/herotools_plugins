<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coverings Model
 *
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 * @property \Cake\ORM\Association\HasMany $Coveringlocations
 *
 * @method \Vorien\HeroCombat\Model\Entity\Covering get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Covering findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoveringsTable extends Table
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

        $this->table('coverings');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Characterprotections', [
            'foreignKey' => 'covering_id',
            'className' => 'Vorien/HeroCombat.Characterprotections'
        ]);
        $this->hasMany('Coveringlocations', [
            'foreignKey' => 'covering_id',
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
            ->allowEmpty('name');

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
