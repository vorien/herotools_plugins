<?php
namespace Vorien\NPCData\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\NPCData\Model\Table\MotivationsTable;

/**
 * Vorien\NPCData\Model\Table\MotivationsTable Test Case
 */
class MotivationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\NPCData\Model\Table\MotivationsTable
     */
    public $Motivations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/n_p_c_data.motivations',
        'plugin.vorien/n_p_c_data.personas',
        'plugin.vorien/n_p_c_data.personas_motivations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Motivations') ? [] : ['className' => 'Vorien\NPCData\Model\Table\MotivationsTable'];
        $this->Motivations = TableRegistry::get('Motivations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Motivations);

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
