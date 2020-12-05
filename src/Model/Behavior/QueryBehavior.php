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
     *
     * @var int
     */
    private const LIMIT = 100;

    /**
     * Set default page
     *
     * @var int
     */
    private const PAGE = 1;

    /**
     * Resolve default options
     *
     * @param  array $options Set Options
     * @return array
     */
    public function resolve(array $options = [])
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'limit' => self::LIMIT,
            'page' => self::PAGE,
            'orderBy' => ['id' => 'DESC'],
            'hydrate' => false,
        ]);

        return $resolver->resolve($options);
    }

    /**
     * Get single record
     *
     * @param  array $fields Fields
     * @param  array $conditions Conditions
     * @param  array $options Options
     * @return \Cake\Datasource\QueryInterface
     */
    public function getRecord($fields = [], $conditions = [], $options = [])
    {
        $options = $this->resolve($options);

        return $this->getTable()
            ->find()
            ->enableHydration($options['hydrate'])
            ->select($fields)
            ->where($conditions)
            ->first();
    }

    /**
     * Get list of records
     *
     * @param  array $fields Fields
     * @param  array $conditions Conditions
     * @param  array $options Options
     * @return \Cake\Database\Query
     */
    public function getRecords($fields = [], $conditions = [], $options = [])
    {
        $options = $this->resolve($options);

        return $this->getTable()
            ->find()
            ->enableHydration($options['hydrate'])
            ->select($fields)
            ->where($conditions)
            ->order($options['orderBy'])
            ->limit($options['limit'])
            ->page($options['page'])
            ->toArray();
    }

    /**
     * Save record
     *
     * @param  array $data Key value list of fields to be merged into the entity.
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function saveRecord($data)
    {
        $entity = $this->getTable()->newEntity();
        $entity = $this->getTable()->patchEntity($entity, $data);

        return $this->getTable()->save($entity);
    }

    /**
     * Update record
     *
     * @param  int $id Primary key value to find.
     * @param  array $data Key value list of fields to be merged into the entity.
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function updateRecord($id, $data)
    {
        $entity = $this->getTable()->get($id);
        $entity = $this->getTable()->patchEntity($entity, $data);

        return $this->getTable()->save($entity);
    }
}
