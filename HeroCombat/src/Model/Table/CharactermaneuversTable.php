<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Charactermaneuvers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characterstats
 * @property \Cake\ORM\Association\BelongsTo $Maneuvers
 *
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Charactermaneuver findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharactermaneuversTable extends Table
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

        $this->table('charactermaneuvers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characterstats', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Characterstats'
        ]);
        $this->belongsTo('Maneuvers', [
            'foreignKey' => 'maneuver_id',
            'className' => 'Vorien/HeroCombat.Maneuvers'
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
        $rules->add($rules->existsIn(['characterstat_id'], 'Characterstats'));
        $rules->add($rules->existsIn(['maneuver_id'], 'Maneuvers'));

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
