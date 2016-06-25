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
        'plugin.vorien/hero_combat.levels',
        'plugin.vorien/hero_combat.characterweapons'
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
