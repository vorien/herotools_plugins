<?php
namespace Vorien\NPCData\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\NPCData\Model\Entity\Quirk;

/**
 * Quirks Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Personas
 */
class QuirksTable extends Table
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

        $this->table('quirks');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Personas', [
            'foreignKey' => 'quirk_id',
            'targetForeignKey' => 'persona_id',
            'through' => 'Vorien/NPCData.PersonasQuirks',
            'className' => 'Vorien/NPCData.Personas'
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
        return 'npcdata';
    }
}
