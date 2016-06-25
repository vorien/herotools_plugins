<?php
namespace Vorien\NPCData\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Vorien\NPCData\Model\Entity\Persona;

/**
 * Personas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Agendas
 * @property \Cake\ORM\Association\HasMany $Notes
 * @property \Cake\ORM\Association\BelongsToMany $Archetypes
 * @property \Cake\ORM\Association\BelongsToMany $Flaws
 * @property \Cake\ORM\Association\BelongsToMany $Guilds
 * @property \Cake\ORM\Association\BelongsToMany $Motivations
 * @property \Cake\ORM\Association\BelongsToMany $Qualities
 * @property \Cake\ORM\Association\BelongsToMany $Quirks
 */
class PersonasTable extends Table
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

        $this->table('personas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('People', [
            'foreignKey' => 'person_id',
            'className' => 'Vorien/NPCData.People'
        ]);
        $this->belongsTo('Agendas', [
            'foreignKey' => 'agenda_id',
            'className' => 'Vorien/NPCData.Agendas'
        ]);
        $this->hasMany('Notes', [
            'foreignKey' => 'persona_id',
            'className' => 'Vorien/NPCData.Notes'
        ]);
        $this->belongsToMany('Archetypes', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'archetype_id',
            'through' => 'Vorien/NPCData.ArchetypesPersonas',
            'className' => 'Vorien/NPCData.Archetypes'
        ]);
        $this->belongsToMany('Flaws', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'flaw_id',
            'through' => 'Vorien/NPCData.FlawsPersonas',
            'className' => 'Vorien/NPCData.Flaws'
        ]);
        $this->belongsToMany('Guilds', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'guild_id',
            'through' => 'Vorien/NPCData.GuildsPersonas',
            'className' => 'Vorien/NPCData.Guilds'
        ]);
        $this->belongsToMany('Motivations', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'motivation_id',
            'through' => 'Vorien/NPCData.MotivationsPersonas',
            'className' => 'Vorien/NPCData.Motivations'
        ]);
        $this->belongsToMany('Qualities', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'quality_id',
            'through' => 'Vorien/NPCData.PersonasQualities',
            'className' => 'Vorien/NPCData.Qualities'
        ]);
        $this->belongsToMany('Quirks', [
            'foreignKey' => 'persona_id',
            'targetForeignKey' => 'quirk_id',
            'through' => 'Vorien/NPCData.PersonasQuirks',
            'className' => 'Vorien/NPCData.Quirks'
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
            ->allowEmpty('profession');

        $validator
            ->allowEmpty('employer');

        $validator
            ->integer('influence')
            ->allowEmpty('influence');

        $validator
            ->integer('wealth')
            ->allowEmpty('wealth');

        $validator
            ->allowEmpty('picture');

        $validator
            ->allowEmpty('gender');

        $validator
            ->integer('generosity')
            ->allowEmpty('generosity');

        $validator
            ->integer('decency')
            ->allowEmpty('decency');

        $validator
            ->integer('reliability')
            ->allowEmpty('reliability');

        $validator
            ->integer('reserve')
            ->allowEmpty('reserve');

        $validator
            ->integer('benevolence')
            ->allowEmpty('benevolence');

        $validator
            ->integer('restraint')
            ->allowEmpty('restraint');

        $validator
            ->integer('moderation')
            ->allowEmpty('moderation');

        $validator
            ->integer('stability')
            ->allowEmpty('stability');

        $validator
            ->integer('outlook')
            ->allowEmpty('outlook');

        $validator
            ->integer('integrity')
            ->allowEmpty('integrity');

        $validator
            ->integer('discipline')
            ->allowEmpty('discipline');

        $validator
            ->integer('spirit')
            ->allowEmpty('spirit');

        $validator
            ->integer('gregariousness')
            ->allowEmpty('gregariousness');

        $validator
            ->integer('conformity')
            ->allowEmpty('conformity');

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
        $rules->add($rules->existsIn(['person_id'], 'People'));
        $rules->add($rules->existsIn(['agenda_id'], 'Agendas'));
        return $rules;
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
