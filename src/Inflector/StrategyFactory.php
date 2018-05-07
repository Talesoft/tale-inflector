<?php
declare(strict_types=1);

namespace Tale\Inflector;

use Tale\Inflector\Strategy\CamelCaseStrategy;
use Tale\Inflector\Strategy\DashRejoinStrategy;
use Tale\Inflector\Strategy\KebabCaseStrategy;
use Tale\Inflector\Strategy\LowerCamelCaseStrategy;
use Tale\Inflector\Strategy\MacroCaseStrategy;
use Tale\Inflector\Strategy\NumberOrdinalStrategy;
use Tale\Inflector\Strategy\PluralStrategy;
use Tale\Inflector\Strategy\SingularStrategy;
use Tale\Inflector\Strategy\SnakeCaseStrategy;
use Tale\Inflector\Strategy\UnderscoreRejoinStrategy;
use Tale\Inflector\Strategy\UppercaseWordsStrategy;

class StrategyFactory implements StrategyFactoryInterface
{
    public const STRATEGY_CAMELIZE = 'camelize';
    public const STRATEGY_DASHERIZE = 'dasherize';
    public const STRATEGY_CANONICALIZE = 'canonicalize';
    public const STRATEGY_VARIABLEIZE = 'variableize';
    public const STRATEGY_CONSTANIZE = 'constantize';
    public const STRATEGY_TABLEIZE = 'tableize';
    public const STRATEGY_UNDERSCORIZE = 'underscorize';
    public const STRATEGY_HUMANIZE = 'humanize';
    public const STRATEGY_PLURALIZE = 'pluralize';
    public const STRATEGY_SINGULARIZE = 'singularize';
    public const STRATEGY_ORDINALIZE = 'ordinalize';

    private $namedStrategies = [
        self::STRATEGY_CAMELIZE => CamelCaseStrategy::class,
        self::STRATEGY_DASHERIZE => DashRejoinStrategy::class,
        self::STRATEGY_CANONICALIZE => KebabCaseStrategy::class,
        self::STRATEGY_VARIABLEIZE => LowerCamelCaseStrategy::class,
        self::STRATEGY_CONSTANIZE => MacroCaseStrategy::class,
        self::STRATEGY_TABLEIZE => SnakeCaseStrategy::class,
        self::STRATEGY_UNDERSCORIZE => UnderscoreRejoinStrategy::class,
        self::STRATEGY_HUMANIZE => UppercaseWordsStrategy::class,
        self::STRATEGY_PLURALIZE => PluralStrategy::class,
        self::STRATEGY_SINGULARIZE => SingularStrategy::class,
        self::STRATEGY_ORDINALIZE => NumberOrdinalStrategy::class
    ];

    private $instances = [];

    /**
     * @return array
     */
    public function getNamedStrategies(): array
    {
        return $this->namedStrategies;
    }

    public function addNamedStrategy(string $name, string $className): self
    {
        $this->validateClassName($className);
        $this->namedStrategies[$name] = $className;
        return $this;
    }

    public function addNamedStrategies(iterable $strategies): self
    {
        foreach ($strategies as $name => $className) {
            $this->addNamedStrategy($name, $className);
        }
        return $this;
    }

    public function resolve(string $className): string
    {
        if (isset($this->namedStrategies[$className])) {
            $className = $this->namedStrategies[$className];
        }

        $this->validateClassName($className);
        return $className;
    }

    public function get(string $className): StrategyInterface
    {
        $className = $this->resolve($className);
        if (isset($this->instances[$className])) {
            return $this->instances[$className];
        }
        return $this->instances[$className] = new $className();
    }

    protected function validateClassName(string $className): void
    {
        if (!is_subclass_of($className, StrategyInterface::class, true)) {
            throw new \InvalidArgumentException(sprintf(
                'Class name passed to %s is not a valid %s class name',
                static::class,
                StrategyInterface::class
            ));
        }
    }
}
