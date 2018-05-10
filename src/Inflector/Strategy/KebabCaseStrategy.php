<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class KebabCaseStrategy extends DashStrategy
{
    public function inflect(string $string): string
    {
        return strtolower(parent::inflect($string));
    }
}
