<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class CamelCaseStrategy extends UppercaseWordsStrategy
{
    public function inflect(string $string): string
    {
        return str_replace(self::DELIMITER, '', parent::inflect($string));
    }
}
