<?php
declare(strict_types=1);

namespace Tale;

use Tale\Inflector\StrategyFactory;
use Tale\Inflector\StrategyFactoryInterface;

class Inflector
{
    private $strategyFactory;

    /**
     * Inflector constructor.
     * @param StrategyFactoryInterface $strategyFactory
     */
    public function __construct(StrategyFactoryInterface $strategyFactory = null)
    {
        $this->strategyFactory = $strategyFactory ?: new StrategyFactory();
    }

    /**
     * @return StrategyFactoryInterface
     */
    public function getStrategyFactory(): StrategyFactoryInterface
    {
        return $this->strategyFactory;
    }

    public function addNamedStrategy(string $name, string $className): self
    {
        $this->strategyFactory->addNamedStrategy($name, $className);
        return $this;
    }

    public function inflect(string $string, array $strategies): string
    {
        foreach ($strategies as $className) {
            $strategy = $this->strategyFactory->get($className);
            $string = $strategy->inflect($string);
        }
        return $string;
    }

    public static function create(StrategyFactoryInterface $strategyFactory = null)
    {
        return new self($strategyFactory);
    }

    public static function inflectString(string $string, array $strategies, StrategyFactoryInterface $strategyFactory = null): string
    {
        return self::create($strategyFactory)->inflect($string, $strategies);
    }

    /**
     * Returns the plural representation of a singular string.
     *
     * e.g. car => cars, house => houses, user-group => user-groups
     *
     * @param string $string The singular string to be translated
     *
     * @return string The plural representation of the passed singular string
     */
    public static function pluralize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_PLURALIZE]);
    }

    /**
     * Returns the singular representation of a plural string.
     *
     * e.g. cars => car, houses => house, user-groups => user-group
     *
     * @param string $string The plural string to be translated
     *
     * @return string The singular representation of the passed singular string
     */
    public static function singularize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_SINGULARIZE]);
    }

    /**
     * Returns a "Human Readable" representation of a string.
     *
     * (Basically, reJoin paired with ucwords)
     *
     * e.g. SomeClassName   => Some Class Name
     *      some_table_name => Some Table Name
     *
     * @param string      $string The subject string
     *
     * @return string The "Human Readable" string
     */
    public static function humanize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_HUMANIZE]);
    }

    /**
     * Returns a CamelCased representation of a string.
     *
     * (Basically, humanize without the spaces between)
     *
     * Works best for inflecting strings to class-names
     *
     * e.g. Some String     => SomeString
     *      some_table_name => SomeTableName
     *
     * @param string      $string The subject string
     *
     * @return string The CamelCased string
     */
    public static function camelize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_CAMELIZE]);
    }

    /**
     * Returns a dash-separated representation of a string.
     *
     * (Normal reJoin with "-"-delimiter)
     * The casing returned is the same as the input string
     *
     * e.g. SomeClassName   => Some-Class-Name
     *      some_table_name => some-table-name
     *
     * @param string      $string The subject string
     *
     * @return string The dash-separated string
     */
    public static function dasherize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_DASHERIZE]);
    }

    /**
     * Returns a underscore_separated representation of a string.
     *
     * (Normal reJoin with "_"-delimiter)
     * The casing returned is the same as the input string
     *
     * e.g. SomeClassName   => Some_Class_Name
     *      some-view-name  => some_view_name
     *
     * @param string      $string The subject string
     *
     * @return string The underscore_separated string
     */
    public static function underscorize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_UNDERSCORIZE]);
    }

    /**
     * Returns a camelCased string with the first word lowercased.
     *
     * (Basically, camelize paired with lcfirst)
     *
     * Works best for inflecting strings to variable- or method-names
     *
     * e.g. SomeClassName   => someClassName
     *      some_table_name => someTableName
     *
     * @param string      $string The subject string
     *
     * @return string The camelCased string
     */
    public static function variablize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_VARIABLEIZE]);
    }

    /**
     * Returns a lower_cased_dash_separated string.
     *
     * (Basically, underscorize paired with strtolower)
     *
     * Works best for inflecting strings to table-names in RDBMS
     *
     * e.g. SomeClassName   => some_class_name
     *      some-view-name  => some_view_name
     *
     * @param string      $string The subject string
     *
     * @return string The lower_cased_dash_separated string
     */
    public static function tableize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_TABLEIZE]);
    }

    /**
     * Returns a lower-cased-dash-separated string.
     *
     * (Basically, dasherize paired with strtolower)
     *
     * Works best for inflecting strings to file-names or slugs/mnemonic strings
     *
     * e.g. SomeClassName   => some-class-name
     *      some_table_name => some-table-name
     *
     * @param string      $string The subject string
     *
     * @return string The lower-cased-dash-separated string
     */
    public static function canonicalize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_CANONICALIZE]);
    }

    /**
     * Creates a rd, nd, th representation of a number
     *
     * e.g. 1    => 1st
     *      2    => 2nd
     *      3    => 3rd
     *      4    => 4th
     *      123  => 123rd
     *
     * @param string|int $string The input number or number-string
     *
     * @return string       The ordinalized representation of the input number
     */
    public static function ordinalize(string $string): string
    {
        return self::inflectString($string, [StrategyFactory::STRATEGY_ORDINALIZE]);
    }
}
