<?php
declare(strict_types=1);

namespace Tale\Inflector;

interface StrategyFactoryInterface
{
    public function resolve(string $className): string;
    public function get(string $className): StrategyInterface;
}
