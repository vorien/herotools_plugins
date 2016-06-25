<?php
namespace Vorien\HeroCombat\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\HeroCombat\Model\Entity\CharacterlevelsCharacterweapon;

/**
 * CharacterlevelsCharacterweapons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characterlevels
 * @property \Cake\ORM\Association\BelongsTo $Characterweapons
 */
class CharacterlevelsCharacterweaponsTable extends Table
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

        $this->table('characterlevels_characterweapons');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Characterlevels', [
            'foreignKey' => 'characterlevel_id',
            'className' => 'Vorien/HeroCombat.Characterlevels'
        ]);
        $this->belongsTo('Characterweapons', [
            'foreignKey' => 'characterweapon_id',
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
        $rules->add($rules->existsIn(['characterlevel_id'], 'Characterlevels'));
        $rules->add($rules->existsIn(['characterweapon_id'], 'Characterweapons'));
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
