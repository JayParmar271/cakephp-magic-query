<?php
namespace MagicQuery\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductsFixture
 */
class ProductsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Product 1',
                'description' => 'Product desc 1',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 2,
                'name' => 'Product 2',
                'description' => 'Product desc 2',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 3,
                'name' => 'Product 3',
                'description' => 'Product desc 3',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 4,
                'name' => 'Product 4',
                'description' => 'Product desc 4',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 5,
                'name' => 'Product 5',
                'description' => 'Product desc 5',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 6,
                'name' => 'Product 6',
                'description' => 'Product desc 6',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 7,
                'name' => 'Product 7',
                'description' => 'Product desc 7',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 8,
                'name' => 'Product 8',
                'description' => 'Product desc 8',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 9,
                'name' => 'Product 9',
                'description' => 'Product desc 9',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],
            [
                'id' => 10,
                'name' => 'Product 10',
                'description' => 'Product desc 10',
                'created' => '2020-12-12 07:05:09',
                'modified' => '2020-12-12 07:05:09',
            ],

        ];
        parent::init();
    }
}
