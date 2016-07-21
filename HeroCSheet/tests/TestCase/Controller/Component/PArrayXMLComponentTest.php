<?php
namespace Vorien\HeroCSheet\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCSheet\Controller\Component\PArrayXMLComponent;

/**
 * Vorien\HeroCSheet\Controller\Component\PArrayXMLComponent Test Case
 */
class PArrayXMLComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCSheet\Controller\Component\PArrayXMLComponent
     */
    public $PArrayXMLComponent;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->PArrayXMLComponent = new PArrayXMLComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PArrayXMLComponent);

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
