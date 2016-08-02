<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Armors Model
 *
 * @property \Cake\ORM\Association\HasMany $Armormaterials
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 *
 * @method \Vorien\HeroCombat\Model\Entity\Armor get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armor findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArmorsTable extends Table
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

        $this->table('armors');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Armormaterials', [
            'foreignKey' => 'armor_id',
            'className' => 'Vorien/HeroCombat.Armormaterials'
        ]);
        $this->hasMany('Characterprotections', [
            'foreignKey' => 'armor_id',
            'className' => 'Vorien/HeroCombat.Characterprotections'
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
            ->allowEmpty('armor');

        $validator
            ->integer('r_pd')
            ->allowEmpty('r_pd');

        $validator
            ->integer('r_ed')
            ->allowEmpty('r_ed');

        $validator
            ->integer('training_penalty')
            ->allowEmpty('training_penalty');

        $validator
            ->allowEmpty('ar_cost');

        $validator
            ->numeric('weight')
            ->allowEmpty('weight');

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
