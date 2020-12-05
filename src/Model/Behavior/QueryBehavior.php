<?php
namespace MagicQuery\Model\Behavior;

use Cake\ORM\Behavior;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Query behavior
 */
class QueryBehavior extends Behavior
{
    /**
     * Set default limit
     */
    private const LIMIT = 100;

    /**
     * Set default page
     */
    private const PAGE = 1;

    /**
     * Resolve default options
     *
     * @param array $options Set Options
     * @return array
     */
    public function resolve(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'limit' => self::LIMIT,
            'page' => self::PAGE,
            'orderBy' => ['id' => 'DESC'],
        ]);

        return $resolver->resolve($options);
    }

    /**
     * Get single record
     *
     * @param int $id Id
     * @return \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function getRecord($id)
    {
        return $this->getTable()->get(
            $id,
            [
                'contain' => [],
            ]
        );
    }

    /**
     * Get list of records
     *
     * @param  array  $fields Fields
     * @param  array  $conditions Conditions
     * @param  array  $options Options
     * @return \Cake\Datasource\Exception\RecordNotFoundException
     */
    public function getRecords($fields = [], $conditions = [], $options = [])
    {
        $options = $this->resolve($options);

        return $this->getTable()
            ->find()
            ->select($fields)
            ->where($conditions)
            ->order($options['orderBy'])
            ->limit($options['limit'])
            ->page($options['page']);
    }

    /**
     * Save record
     *
     * @param array $data Data
     * @return array
     */
    public function saveRecord($data)
    {
        $table = $this->getTable()->newEntity();
        $table = $this->getTable()->patchEntity($table, $data);

        return $this->getTable()->save($table);
    }

    /**
     * Update record
     *
     * @param  int $id Unique id
     * @param  array $data Data
     *
     * @return array
     */
    public function updateRecord($id, $data)
    {
        $table = $this->getTable()->get(
            $id,
            [
                'contain' => [],
            ]
        );

        $table = $this->getTable()->patchEntity($table, $data);

        return $this->getTable()->save($table);
    }
}
