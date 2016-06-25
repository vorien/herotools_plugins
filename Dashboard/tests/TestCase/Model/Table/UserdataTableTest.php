<?php
namespace Vorien\Dashboard\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\Dashboard\Model\Table\UserdataTable;

/**
 * Vorien\Dashboard\Model\Table\UserdataTable Test Case
 */
class UserdataTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\Dashboard\Model\Table\UserdataTable
     */
    public $Userdata;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/dashboard.userdata',
        'plugin.vorien/dashboard.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Userdata') ? [] : ['className' => 'Vorien\Dashboard\Model\Table\UserdataTable'];
        $this->Userdata = TableRegistry::get('Userdata', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Userdata);

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
