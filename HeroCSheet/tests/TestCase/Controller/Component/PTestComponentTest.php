<?php
namespace Vorien\HeroCSheet\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCSheet\Controller\Component\PTestComponent;

/**
 * Vorien\HeroCSheet\Controller\Component\PTestComponent Test Case
 */
class PTestComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCSheet\Controller\Component\PTestComponent
     */
    public $PTestComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->PTestComponent = new PTestComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PTestComponent);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
