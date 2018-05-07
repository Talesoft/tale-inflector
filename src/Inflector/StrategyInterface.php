<?php
declare(strict_types=1);

namespace Tale\Inflector;

interface StrategyInterface
{
    public function inflect(string $string): string;
}
