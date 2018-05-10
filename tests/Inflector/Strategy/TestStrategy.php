<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use Tale\Inflector\StrategyInterface;

class TestStrategy implements StrategyInterface
{
    public function inflect(string $string): string
    {
        return strtoupper($string);
    }
}
