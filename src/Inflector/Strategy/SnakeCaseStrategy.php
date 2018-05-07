<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class SnakeCaseStrategy extends UnderscoreRejoinStrategy
{
    public function inflect(string $string): string
    {
        return strtolower(parent::inflect($string));
    }
}
