<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class UppercaseWordsStrategy extends RejoinStrategy
{
    public function inflect(string $string): string
    {
        return ucwords(strtolower(parent::inflect($string)));
    }
}
