<?php
namespace Vorien\HeroCSheet\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCSheet\Model\Table\CharactersheetsTable;

/**
 * Vorien\HeroCSheet\Model\Table\CharactersheetsTable Test Case
 */
class CharactersheetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCSheet\Model\Table\CharactersheetsTable
     */
    public $Charactersheets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.vorien/hero_c_sheet.charactersheets',
        'plugin.vorien/hero_c_sheet.characters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Charactersheets') ? [] : ['className' => 'Vorien\HeroCSheet\Model\Table\CharactersheetsTable'];
        $this->Charactersheets = TableRegistry::get('Charactersheets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Charactersheets);

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
