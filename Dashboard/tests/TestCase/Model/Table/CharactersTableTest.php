<?php
namespace Vorien\Dashboard\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\Dashboard\Model\Table\CharactersTable;

/**
 * Vorien\Dashboard\Model\Table\CharactersTable Test Case
 */
class CharactersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\Dashboard\Model\Table\CharactersTable
     */
    public $Characters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/dashboard.characters',
        'plugin.vorien/dashboard.userdata',
        'plugin.vorien/dashboard.users',
        'plugin.vorien/dashboard.gms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Characters') ? [] : ['className' => 'Vorien\Dashboard\Model\Table\CharactersTable'];
        $this->Characters = TableRegistry::get('Characters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Characters);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
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
