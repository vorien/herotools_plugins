<?php
namespace Vorien\HeroCombat\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCombat\Model\Table\CoveringlocationsTable;

/**
 * Vorien\HeroCombat\Model\Table\CoveringlocationsTable Test Case
 */
class CoveringlocationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCombat\Model\Table\CoveringlocationsTable
     */
    public $Coveringlocations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_combat.coveringlocations',
        'plugin.vorien/hero_combat.coverings',
        'plugin.vorien/hero_combat.locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Coveringlocations') ? [] : ['className' => 'Vorien\HeroCombat\Model\Table\CoveringlocationsTable'];
        $this->Coveringlocations = TableRegistry::get('Coveringlocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Coveringlocations);

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
