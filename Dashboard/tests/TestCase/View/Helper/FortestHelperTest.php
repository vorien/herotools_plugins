<?php
namespace Vorien\Dashboard\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use Vorien\Dashboard\View\Helper\FortestHelper;

/**
 * Vorien\Dashboard\View\Helper\FortestHelper Test Case
 */
class FortestHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\Dashboard\View\Helper\FortestHelper
     */
    public $Fortest;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Fortest = new FortestHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fortest);

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
