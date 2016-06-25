<?php
namespace Vorien\HeroCombat\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCombat\Model\Table\CharactermaneuversTable;

/**
 * Vorien\HeroCombat\Model\Table\CharactermaneuversTable Test Case
 */
class CharactermaneuversTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCombat\Model\Table\CharactermaneuversTable
     */
    public $Charactermaneuvers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_combat.charactermaneuvers',
        'plugin.vorien/hero_combat.characters',
        'plugin.vorien/hero_combat.maneuvers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Charactermaneuvers') ? [] : ['className' => 'Vorien\HeroCombat\Model\Table\CharactermaneuversTable'];
        $this->Charactermaneuvers = TableRegistry::get('Charactermaneuvers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Charactermaneuvers);

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
