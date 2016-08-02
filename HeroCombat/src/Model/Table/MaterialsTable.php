<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materials Model
 *
 * @property \Cake\ORM\Association\HasMany $Armormaterials
 * @property \Cake\ORM\Association\HasMany $Characterprotections
 *
 * @method \Vorien\HeroCombat\Model\Entity\Material get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Material findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaterialsTable extends Table
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

        $this->table('materials');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Armormaterials', [
            'foreignKey' => 'material_id',
            'className' => 'Vorien/HeroCombat.Armormaterials'
        ]);
        $this->hasMany('Characterprotections', [
            'foreignKey' => 'material_id',
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
            ->allowEmpty('material');

        $validator
            ->allowEmpty('manufacture');

        $validator
            ->allowEmpty('option');

        $validator
            ->integer('r_pd')
            ->allowEmpty('r_pd');

        $validator
            ->integer('r_ed')
            ->allowEmpty('r_ed');

        $validator
            ->numeric('weightmultiplier')
            ->allowEmpty('weightmultiplier');

        $validator
            ->numeric('grade')
            ->allowEmpty('grade');

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
