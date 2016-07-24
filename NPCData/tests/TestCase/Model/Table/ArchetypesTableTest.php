<?php
namespace Vorien\NPCData\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\NPCData\Model\Table\ArchetypesTable;

/**
 * Vorien\NPCData\Model\Table\ArchetypesTable Test Case
 */
class ArchetypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\NPCData\Model\Table\ArchetypesTable
     */
    public $Archetypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/n_p_c_data.archetypes',
        'plugin.vorien/n_p_c_data.personas',
        'plugin.vorien/n_p_c_data.personas_archetypes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Archetypes') ? [] : ['className' => 'Vorien\NPCData\Model\Table\ArchetypesTable'];
        $this->Archetypes = TableRegistry::get('Archetypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Archetypes);

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
