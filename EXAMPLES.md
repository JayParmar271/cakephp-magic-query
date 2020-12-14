### Examples:

1. ```getRecord($fields, $conditions, $options):``` To retrieve single record
   ##### Options:
    - hydrate: true,false to enable, disable hydration

    - contain: To get relation data

    ```
    $this->Users->getRecord(['id', 'name'], ['id' => '1'], $options);
    ```

2. ```getRecords($fields, $conditions, $options):``` To retrieve records
    ##### Options:
    - hydrate: true,false to enable, disable hydration

    - orderBy: get record according to order

    - limit: Set limit

    - contain: To get relation data

    ```
    $options = [
        'hydrate' => true, // To enable hydration
        'orderBy' => ['id' => 'DESC'],
        'limit' => '100',
        'contain' => 'Products',
    ];
    
    $this->Users->getRecords(
        ['id', 'name'],
        ['id' => '1'],
        $options
    );
    ```

3. ```saveRecord($data):``` To save single record
    ```
    $this->Users->saveRecord(['name' => 'Frank', 'age' => '55']);
    ```

4. ```saveRecords($data):``` To save multiple records
    ```
    $data = [
        [
            'name' => 'Jay',
            'age' => '24',
        ],
        [
            'name' => 'Ishan',
            'age' => '26',
        ],
    ];

    $this->Users->saveRecords($data);
    ```

5. ```updateRecord($id, $data):``` To update single record
    ```
    $this->Users->saveRecords(['id' => 1], ['age' => '25']);
    ```

6. ```updateRecords($data, $conditions):``` To update into multiple rows
    ```
    $this->Users->updateRecords(['age' => '25'], ['name' => 'Jay']);
    ```

7. ```deleteRecord($conditions):``` To delete single record
    ```
    $this->Users->deleteRecord(['name' => 'Frank']);
    ```

8. ```deleteRecordById($id):``` To delete record by id
    ```
    $this->Users->deleteRecordById($id);
    ```

9. ```deleteRecords($conditions):``` To delete multiple records
    ```
    $this->Users->deleteRecords(['age' => '25']);
    ```

10. ```countRecords($conditions):``` To count records
    ```
    $this->Users->countRecords(['name' => 'Ishan']);
    ```
