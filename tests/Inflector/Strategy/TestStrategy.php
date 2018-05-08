<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

use Tale\Inflector\StrategyInterface;

class TestStrategy implements StrategyInterface
{
    public function inflect(string $string): string
    {
        return strtoupper($string);
    }
}
