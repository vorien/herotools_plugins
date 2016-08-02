<?php
namespace Vorien\HeroCombat\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCombat\Model\Table\CharacterlevelsCharacterweaponsTable;

/**
 * Vorien\HeroCombat\Model\Table\CharacterlevelsCharacterweaponsTable Test Case
 */
class CharacterlevelsCharacterweaponsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCombat\Model\Table\CharacterlevelsCharacterweaponsTable
     */
    public $CharacterlevelsCharacterweapons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_combat.characterlevels_characterweapons',
        'plugin.vorien/hero_combat.characterlevels',
        'plugin.vorien/hero_combat.characters',
        'plugin.vorien/hero_combat.charactersheets',
        'plugin.vorien/hero_combat.userdata',
        'plugin.vorien/hero_combat.users',
        'plugin.vorien/hero_combat.gms',
        'plugin.vorien/hero_combat.charactermaneuvers',
        'plugin.vorien/hero_combat.maneuvers',
        'plugin.vorien/hero_combat.characterprotections',
        'plugin.vorien/hero_combat.locations',
        'plugin.vorien/hero_combat.targets',
        'plugin.vorien/hero_combat.coveringlocations',
        'plugin.vorien/hero_combat.coverings',
        'plugin.vorien/hero_combat.armors',
        'plugin.vorien/hero_combat.armormaterials',
        'plugin.vorien/hero_combat.materials',
        'plugin.vorien/hero_combat.characterweapons',
        'plugin.vorien/hero_combat.weapons',
        'plugin.vorien/hero_combat.levels'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CharacterlevelsCharacterweapons') ? [] : ['className' => 'Vorien\HeroCombat\Model\Table\CharacterlevelsCharacterweaponsTable'];
        $this->CharacterlevelsCharacterweapons = TableRegistry::get('CharacterlevelsCharacterweapons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CharacterlevelsCharacterweapons);

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
