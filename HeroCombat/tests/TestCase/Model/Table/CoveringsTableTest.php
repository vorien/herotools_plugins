<?php
namespace Vorien\HeroCombat\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCombat\Model\Table\CoveringsTable;

/**
 * Vorien\HeroCombat\Model\Table\CoveringsTable Test Case
 */
class CoveringsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCombat\Model\Table\CoveringsTable
     */
    public $Coverings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_combat.coverings',
        'plugin.vorien/hero_combat.characterprotections',
        'plugin.vorien/hero_combat.characters',
        'plugin.vorien/hero_combat.users',
        'plugin.vorien/hero_combat.gms',
        'plugin.vorien/hero_combat.characterlevels',
        'plugin.vorien/hero_combat.levels',
        'plugin.vorien/hero_combat.characterweapons',
        'plugin.vorien/hero_combat.weapons',
        'plugin.vorien/hero_combat.characterlevels_characterweapons',
        'plugin.vorien/hero_combat.charactermaneuvers',
        'plugin.vorien/hero_combat.maneuvers',
        'plugin.vorien/hero_combat.locations',
        'plugin.vorien/hero_combat.armors',
        'plugin.vorien/hero_combat.armormaterials',
        'plugin.vorien/hero_combat.materials',
        'plugin.vorien/hero_combat.coveringlocations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Coverings') ? [] : ['className' => 'Vorien\HeroCombat\Model\Table\CoveringsTable'];
        $this->Coverings = TableRegistry::get('Coverings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Coverings);

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
