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

    /**
     * Test get records options
     *
     * @return void
     */
    public function testGetRecordsResultOptions()
    {
        // Test limit option
        $products = $this->Products->getRecords([], [], ['limit' => 2]);

        $this->assertCount(2, $products);

        // Test page and order by option
        $products = $this->Products->getRecords(
            ['name'],
            [],
            ['page' => 2, 'limit' => 2, 'orderBy' => ['id' => 'ASC']]
        );

        $this->assertEquals('Product 3', $products[0]['name']);
        $this->assertCount(2, $products);
    }

    /**
     * Test get record
     *
     * @return void
     */
    public function testGetRecord()
    {
        $product = $this->Products->getRecord([], ['id' => 1]);

        $this->assertTrue(is_array($product));
        $this->assertFalse(is_object($product));

        $product = $this->Products->getRecord([], ['id' => 1], ['hydrate' => true]);

        $this->assertFalse(is_array($product));
        $this->assertTrue(is_object($product));

        // Test order by option
        $product = $this->Products->getRecord(
            ['name'],
            [],
            ['page' => 2, 'limit' => 2, 'orderBy' => ['id' => 'ASC']]
        );
        $this->assertEquals('Product 1', $product['name']);
        $this->assertCount(1, $product);
    }
}
