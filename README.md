
Tale Inflector
==============

What is Tale Inflector?
-----------------------

Tale inflector bends strings into different naming styles.
A common use-case would be the converting of class-names or property-names 
to table-names or titles to slugs for URLs.

Installation
------------

```bash
composer require talesoft/tale-inflector
```

Usage
-----

```php
use Tale\Inflector;

$inflector = new Inflector();

//Table generation
$inflector->inflect('ProductAttribute', ['tableize', 'pluralize']); //product_attributes
$inflector->inflect('someProperty', ['tableize']); //some_property

//Canonicalization / slugs
$inflector->inflect('Some title I inserted', ['canonicalize']); //some-title-i-inserted
$inflector->inflect('Was höre ich da?', ['canonicalize']); //was-hore-ich-da

//Or just use the static methods for quick access
Inflector::canonicalize('Some random title'); //some-random-title
```

Available strategies/static methods
-----------------------------------

### camelize

> Tale\Inflector\Strategy\CamelCaseStrategy

    some Random string = SomeRandomString

### dasherize

> Tale\Inflector\Strategy\DashRejoinStrategy

    some Random string = some-Random-string

### canonicalize

> Tale\Inflector\Strategy\KebabCaseStrategy

    some Random string = some-random-string

### variableize

> Tale\Inflector\Strategy\LowerCamelCaseStrategy

    some Random string = someRandomString

### constantize

> Tale\Inflector\Strategy\MacroCaseStrategy

    some Random string = SOME_RANDOM_STRING

### tableize

> Tale\Inflector\Strategy\SnakeCaseStrategy

    some Random string = some_random_string

### underscorize

> Tale\Inflector\Strategy\UnderscoreRejoinStrategy

    some Random string = some_Random_string

### humanize

> Tale\Inflector\Strategy\UppercaseWordsStrategy

    some Random string = Some Random String

### ordinalize

> Tale\Inflector\Strategy\NumberOrdinalStrategy

    1 = 1st
    12 = 12th
    23 = 23rd

### pluralize

> Tale\Inflector\Strategy\MacroCaseStrategy

    rabbit = rabbits
    car = cars
    house = houses

### singularize

> Tale\Inflector\Strategy\MacroCaseStrategy

    rabbits = rabbit
    cars = car
    houses = house
    

Roll your own
-------------

 ```php
use Tale\Inflector\StrategyInterface;

class MyInflectionStrategy implements StrategyInterface
{
    public function inflect(string $string): string
    {
        return "!! {$string} !!";
    }
}
 
$inflector->inflect('Test', [MyInflectionStrategy::class]); //!! Test !!
 ```
 
You can register your own short names
 
```php
use Tale\Inflector\StrategyInterface;

class MyInflectionStrategy implements StrategyInterface
{
    public function inflect(string $string): string
    {
        return "!! {$string} !!";
    }
}

$inflector->addNamedStrategy('exlamize', MyInflectionStrategy::class);
$inflector->inflect('House', ['pluralize', 'exclamize']); //!! Houses !!
```