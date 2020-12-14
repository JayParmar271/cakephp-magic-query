<?php
namespace MagicQuery\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MagicQuery\Model\Table\UsersTable;

/**
 * MagicQuery\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MagicQuery\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.MagicQuery.Users',
        'plugin.MagicQuery.Products',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
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
     * Test Get record with contain
     *
     * @return void
     */
    public function testGetRecordWithContain()
    {
        $user = $this->Users->getRecord([], ['id' => 1], ['contain' => 'Products']);

        $this->assertNotEmpty($user['products']);
        $this->assertTrue(is_array($user['products']));
    }

    /**
     * Test Get records with contain
     *
     * @return void
     */
    public function testGetRecordsWithContain()
    {
        $user = $this->Users->getRecords([], ['id' => 1], ['contain' => 'Products']);

        $this->assertNotEmpty($user[0]['products']);
        $this->assertTrue(is_array($user[0]['products']));
    }
}
