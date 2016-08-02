<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Levels Model
 *
 * @property \Cake\ORM\Association\HasMany $Characterlevels
 *
 * @method \Vorien\HeroCombat\Model\Entity\Level get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Level findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LevelsTable extends Table
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

        $this->table('levels');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Characterlevels', [
            'foreignKey' => 'level_id',
            'className' => 'Vorien/HeroCombat.Characterlevels'
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
            ->allowEmpty('type');

        $validator
            ->integer('cost')
            ->allowEmpty('cost');

        $validator
            ->allowEmpty('color');

        $validator
            ->allowEmpty('uses');

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
