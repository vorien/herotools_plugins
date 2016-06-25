<?php
namespace Vorien\Dashboard\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Vorien\Dashboard\Controller\Component\UsersComponent;

/**
 * Vorien\Dashboard\Controller\Component\UsersComponent Test Case
 */
class UsersComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Vorien\Dashboard\Controller\Component\UsersComponent
     */
    public $Users;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Users = new UsersComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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
