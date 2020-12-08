<?php
namespace MagicQuery\Model\Behavior;

use Cake\Core\Configure;
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
            'limit' => Configure::read('MagicQuery.limit') ?? self::LIMIT,
            'page' => Configure::read('MagicQuery.page') ?? self::PAGE,
            'orderBy' => Configure::read('MagicQuery.orderBy') ?? ['id' => 'DESC'],
            'hydrate' => Configure::read('MagicQuery.hydrate') ?? false,
            'validate' => Configure::read('MagicQuery.validate') ?? true,
        ]);

        return $resolver->resolve($options);
    }

    /**
     * Get single record
     *
     * @param  array $fields Fields
     * @param  array $conditions Conditions
     * @param  array $options Options
     * @return \Cake\Datasource\QueryInterface|null
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
     * @param  array $options Options
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function saveRecord($data, $options = [])
    {
        $options = $this->resolve($options);

        $entity = $this->getTable()->newEntity();
        $entity = $this->getTable()->patchEntity(
            $entity,
            $data,
            ['validate' => $options['validate']]
        );

        if (! empty($entity->getErrors())) {
            return $entity;
        }

        return $this->getTable()->save($entity);
    }

    /**
     * Save records
     *
     * @param  array $data Key value list of fields to be merged into the entity.
     * @return bool|\Cake\Datasource\EntityInterface[]|\Cake\Datasource\ResultSetInterface
     * False on failure, entities list on success.
     */
    public function saveRecords($data)
    {
        $entities = $this->getTable()->newEntities($data);

        return $this->getTable()->saveMany($entities);
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

    /**
     * Update multiple records
     *
     * @param  array $data Key value list of fields to be merged into the entity.
     * @param  array $conditions conditions
     * @return \Cake\Datasource\EntityInterface|false|int
     */
    public function updateRecords($data, $conditions)
    {
        $count = 0;

        $entities = $this->getTable()
            ->find()
            ->where($conditions)
            ->toArray();

        foreach ($entities as $entity) {
            $entity = $this->getTable()->patchEntity($entity, $data);

            if ($this->getTable()->save($entity)) {
                $count += 1;
            }
        }

        return $count;
    }

    /**
     * Delete record by id
     *
     * @param  mixed $id Primary key value to find.
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function deleteRecordById($id)
    {
        $entity = $this->getTable()->get($id);

        return $this->getTable()->delete($entity);
    }

    /**
     * Delete record
     *
     * @param  array $conditions Conditions
     * @return \Cake\Datasource\EntityInterface|false
     */
    public function deleteRecord($conditions)
    {
        $entity = $this->getTable()
            ->find()
            ->where($conditions)
            ->first();

        if (empty($entity)) {
            return false;
        }

        return $this->getTable()->delete($entity);
    }

    /**
     * Delete multiple records
     *
     * @param  array $conditions conditions
     * @return \Cake\Datasource\EntityInterface|false|int
     */
    public function deleteRecords($conditions)
    {
        $count = 0;

        $entities = $this->getTable()
            ->find()
            ->where($conditions)
            ->toArray();

        foreach ($entities as $entity) {
            if ($this->getTable()->delete($entity)) {
                $count += 1;
            }
        }

        return $count;
    }
}
