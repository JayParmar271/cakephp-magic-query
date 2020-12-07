# MagicQuery plugin for CakePHP

[![Latest Stable Version](https://poser.pugx.org/JayParmar271/cakephp-magic-query/v/stable)](https://packagist.org/packages/JayParmar271/cakephp-magic-query)
[![Total Downloads](https://poser.pugx.org/JayParmar271/cakephp-magic-query/downloads)](https://packagist.org/packages/JayParmar271/cakephp-magic-query)
[![License](https://poser.pugx.org/JayParmar271/cakephp-magic-query/license)](https://packagist.org/packages/JayParmar271/cakephp-magic-query)

Simple query builder made with CakePHP

## Requirements
- CakePHP 3.5+ 

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require jayparmar271/cakephp-magic-query
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
