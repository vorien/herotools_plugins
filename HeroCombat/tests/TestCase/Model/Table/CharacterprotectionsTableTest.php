<?php
namespace Vorien\HeroCombat\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCombat\Model\Table\CharacterprotectionsTable;

/**
 * Vorien\HeroCombat\Model\Table\CharacterprotectionsTable Test Case
 */
class CharacterprotectionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCombat\Model\Table\CharacterprotectionsTable
     */
    public $Characterprotections;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_combat.characterprotections',
        'plugin.vorien/hero_combat.characters',
        'plugin.vorien/hero_combat.locations',
        'plugin.vorien/hero_combat.coverings',
        'plugin.vorien/hero_combat.armors',
        'plugin.vorien/hero_combat.armormaterials',
        'plugin.vorien/hero_combat.materials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Characterprotections') ? [] : ['className' => 'Vorien\HeroCombat\Model\Table\CharacterprotectionsTable'];
        $this->Characterprotections = TableRegistry::get('Characterprotections', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Characterprotections);

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
