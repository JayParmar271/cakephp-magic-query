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

    /**
     * Test save record
     *
     * @return void
     */
    public function testSaveRecord()
    {
        $product = $this->Products->saveRecord([
            'name' => 'Casiotone',
            'user_id' => 1,
            'description' => 'This is lorem ipsum dummy test1',
        ]);

        $this->assertEquals('Casiotone', $product['name']);
        $this->assertEquals('This is lorem ipsum dummy test1', $product['description']);
    }

    /**
     * Test save records
     *
     * @return void
     */
    public function testSaveRecords()
    {
        $productsArr = [
            [
                'name' => 'Test product 1',
                'description' => 'This is Test product 1 description',
                'user_id' => 2,
            ],
            [
                'name' => 'Test product 2',
                'description' => 'This is Test product 2 description',
                'user_id' => 2,
            ],
        ];

        $products = $this->Products->saveRecords($productsArr);

        $this->assertCount(2, $products);
        $this->assertEquals('Test product 1', $products[0]['name']);
        $this->assertEquals('This is Test product 1 description', $products[0]['description']);
        $this->assertEquals('Test product 2', $products[1]['name']);
        $this->assertEquals('This is Test product 2 description', $products[1]['description']);
    }

    /**
     * Test update record
     *
     * @return void
     */
    public function testUpdateRecord()
    {
        $product = $this->Products->updateRecord(
            1,
            ['name' => 'Samsung', 'description' => 'Mobile company']
        );

        $this->assertEquals('Samsung', $product['name']);
        $this->assertEquals('Mobile company', $product['description']);
    }

    /**
     * Test update records
     *
     * @return void
     */
    public function testCountAndUpdateRecords()
    {
        $productsCount = $this->Products->countRecords(['description' => 'Product desc']);
        $updatedProducts = $this->Products->updateRecords(
            ['name' => 'Samsung', 'description' => 'Mobile Company'],
            ['description' => 'Product desc']
        );

        $this->assertEquals($productsCount, $updatedProducts);
    }

    /**
     * Test delete record by id
     *
     * @return void
     */
    public function testDeleteRecordById()
    {
        $delete = $this->Products->deleteRecordById(1);

        $this->assertTrue($delete);
    }

    /**
     * Test delete multiple records
     *
     * @return void
     */
    public function testDeleteRecords()
    {
        $productsCount = $this->Products->countRecords(['description' => 'Product desc']);
        $deletedProductCount = $this->Products->deleteRecords(['description' => 'Product desc']);

        $this->assertEquals($productsCount, $deletedProductCount);
    }
}
