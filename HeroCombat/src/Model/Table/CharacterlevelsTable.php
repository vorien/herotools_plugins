<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characterlevels Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characterstats
 * @property \Cake\ORM\Association\BelongsTo $Levels
 * @property \Cake\ORM\Association\BelongsToMany $Characterweapons
 *
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel get($primaryKey, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel newEntity($data = null, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel[] newEntities(array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel[] patchEntities($entities, array $data, array $options = [])
 * @method \Vorien\HeroCombat\Model\Entity\Characterlevel findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CharacterlevelsTable extends Table
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

        $this->table('characterlevels');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characterstats', [
            'foreignKey' => 'characterstat_id',
            'className' => 'Vorien/HeroCombat.Characterstats'
        ]);
        $this->belongsTo('Levels', [
            'foreignKey' => 'level_id',
            'className' => 'Vorien/HeroCombat.Levels'
        ]);
        $this->belongsToMany('Characterweapons', [
            'foreignKey' => 'characterlevel_id',
            'targetForeignKey' => 'characterweapon_id',
            'joinTable' => 'characterlevels_characterweapons',
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
            ->allowEmpty('name');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

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
        $rules->add($rules->existsIn(['level_id'], 'Levels'));

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
