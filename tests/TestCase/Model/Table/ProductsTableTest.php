<?php
namespace MagicQuery\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use MagicQuery\Model\Table\ProductsTable;

/**
 * MagicQuery\Model\Table\ProductsTable Test Case
 */
class ProductsTableTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Test subject
     *
     * @var \MagicQuery\Model\Table\ProductsTable
     */
    public $Products;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Products') ? [] : ['className' => ProductsTable::class];
        $this->Products = TableRegistry::getTableLocator()->get('Products', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Products);

        parent::tearDown();
    }

    /**
     * Test get records function returns result as array
     *
     * @return void
     */
    public function testGetRecordsResultAsArray()
    {
        $products = $this->Products->getRecords();

        $this->assertNotEmpty($products);
        $this->assertTrue(is_array($products[0]));
    }

    /**
     * Test get records function returns result as object
     *
     * @return void
     */
    public function testGetRecordsResultAsObject()
    {
        $products = $this->Products->getRecords([], [], ['hydrate' => true]);

        $this->assertNotEmpty($products);
        $this->assertTrue(is_object($products[0]));
    }
}
