<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class MacroCaseStrategy extends UnderscoreStrategy
{
    public function inflect(string $string): string
    {
        return strtoupper(parent::inflect($string));
    }
}
