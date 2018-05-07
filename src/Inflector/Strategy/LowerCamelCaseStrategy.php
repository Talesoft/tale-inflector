<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class LowerCamelCaseStrategy extends CamelCaseStrategy
{
    public function inflect(string $string): string
    {
        return lcfirst(parent::inflect($string));
    }
}
