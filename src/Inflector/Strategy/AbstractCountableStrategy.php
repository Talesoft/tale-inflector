<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

use Tale\Inflector\StrategyInterface;

abstract class AbstractCountableStrategy implements StrategyInterface
{
    protected const UNCOUNTABLES = [
        'equipment',
        'information',
        'rice',
        'money',
        'species',
        'series',
        'fish',
        'sheep'
    ];

    protected const IRREGULARS = [
        'person' => 'people',
        'man'    => 'men',
        'child'  => 'children',
        'sex'    => 'sexes',
        'move'   => 'moves'
    ];

    protected function isUncountable(string $string): bool
    {
        $string = strtolower($string);
        foreach (static::UNCOUNTABLES as $uncountable) {
            if (substr($string, -1 * \strlen($uncountable)) === $uncountable) {
                return true;
            }
        }
        return false;
    }
}
