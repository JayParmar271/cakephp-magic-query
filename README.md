# MagicQuery plugin for CakePHP

## Requirements
- CakePHP 3.5+ 

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require jayparmar271/cakephpmagic-query
```

## Usage
1. Add behavior in your table.
 ```
     $this->addBehavior('MagicQuery.Query');
 ```

2. Use getRecord() to get single record.
```
    $this->Users->getRecord($id);
```    

## License
The MIT [License](LICENSE). Please see License File for more information.
