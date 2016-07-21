<?php
namespace Vorien\HeroCSheet\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Vorien\HeroCSheet\Controller\Component\PMergeXMLComponent;

/**
 * Vorien\HeroCSheet\Controller\Component\PMergeXMLComponent Test Case
 */
class PMergeXMLComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\HeroCSheet\Controller\Component\PMergeXMLComponent
     */
    public $PMergeXML;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->PMergeXML = new PMergeXMLComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PMergeXML);

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
