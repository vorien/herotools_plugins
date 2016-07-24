<?php
namespace Vorien\NPCData\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\NPCData\Model\Entity\Quality;

/**
 * Qualities Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Personas
 */
class QualitiesTable extends Table
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

        $this->table('qualities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Personas', [
            'foreignKey' => 'quality_id',
            'targetForeignKey' => 'persona_id',
            'joinTable' => 'personas_qualities',
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
