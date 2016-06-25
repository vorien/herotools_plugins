<?php
namespace Vorien\NPCData\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\NPCData\Model\Table\QuirksTable;

/**
 * Vorien\NPCData\Model\Table\QuirksTable Test Case
 */
class QuirksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\NPCData\Model\Table\QuirksTable
     */
    public $Quirks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/n_p_c_data.quirks',
        'plugin.vorien/n_p_c_data.personas',
        'plugin.vorien/n_p_c_data.people',
        'plugin.vorien/n_p_c_data.agendas',
        'plugin.vorien/n_p_c_data.notes',
        'plugin.vorien/n_p_c_data.archetypes',
        'plugin.vorien/n_p_c_data.archetypes_personas',
        'plugin.vorien/n_p_c_data.flaws',
        'plugin.vorien/n_p_c_data.flaws_personas',
        'plugin.vorien/n_p_c_data.guilds',
        'plugin.vorien/n_p_c_data.professions',
        'plugin.vorien/n_p_c_data.guilds_personas',
        'plugin.vorien/n_p_c_data.motivations',
        'plugin.vorien/n_p_c_data.motivations_personas',
        'plugin.vorien/n_p_c_data.qualities',
        'plugin.vorien/n_p_c_data.personas_qualities',
        'plugin.vorien/n_p_c_data.personas_quirks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Quirks') ? [] : ['className' => 'Vorien\NPCData\Model\Table\QuirksTable'];
        $this->Quirks = TableRegistry::get('Quirks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Quirks);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
