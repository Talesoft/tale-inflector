<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

use Tale\Inflector\StrategyInterface;

class OrdinalStrategy implements StrategyInterface
{
    public function inflect(string $string): string
    {
        if (!is_numeric($string)) {
            return $string;
        }

        $number = (int)$string;
        if (!\in_array($number % 100, [11, 12, 13], true)) {
            switch ($number % 10) {
                case 1:
                    return "{$number}st";
                case 2:
                    return "{$number}nd";
                case 3:
                    return "{$number}rd";
            }
        }

        return "{$number}th";
    }
}
