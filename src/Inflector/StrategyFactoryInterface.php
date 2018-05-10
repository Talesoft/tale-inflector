<?php
declare(strict_types=1);

namespace Tale\Inflector;

interface StrategyFactoryInterface
{
    public function getNamedStrategies(): array;
    public function addNamedStrategy(string $name, string $className): self;
    public function addNamedStrategies(iterable $strategies): self;
    public function resolve(string $className): string;
    public function get(string $className): StrategyInterface;
}
