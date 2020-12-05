<?php
namespace MagicQuery\Test\TestCase\Model\Behavior;

use Cake\TestSuite\TestCase;
use MagicQuery\Model\Behavior\QueryBehavior;

/**
 * MagicQuery\Model\Behavior\QueryBehavior Test Case
 */
class QueryBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MagicQuery\Model\Behavior\QueryBehavior
     */
    public $Query;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Query = new QueryBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Query);

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
