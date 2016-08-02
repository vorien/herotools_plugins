<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Armormaterials Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Armors
 * @property \Cake\ORM\Association\BelongsTo $Materials
 *
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Armormaterial findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ArmormaterialsTable extends Table
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

        $this->table('armormaterials');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Armors', [
            'foreignKey' => 'armor_id',
            'className' => 'Vorien/HeroCombat.Armors'
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
            'className' => 'Vorien/HeroCombat.Materials'
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
        $rules->add($rules->existsIn(['armor_id'], 'Armors'));
        $rules->add($rules->existsIn(['material_id'], 'Materials'));

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
