# MagicQuery plugin for CakePHP

## Requirements
- CakePHP 3.5+ 

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require jayparmar271/cakephp-magic-query:0.5.1
```

## Usage
1. Add behavior in your table. (../src/Model/Table/UsersTable.php)
 ```
     $this->addBehavior('MagicQuery.Query');
 ```

2. Use getRecord() to get single record.
```
    $this->Users->getRecord(['name'], ['id' => '1']);
```   
You can find more examples [here](EXAMPLES.md).

## License
The MIT License. Please see [License](LICENSE) File for more information.
