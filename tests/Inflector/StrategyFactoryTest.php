<?php
declare(strict_types=1);

namespace Tale\Test\Inflector;

use PHPUnit\Framework\TestCase;
use stdClass;
use Tale\Inflector\Strategy\CamelCaseStrategy;
use Tale\Inflector\Strategy\DashStrategy;
use Tale\Inflector\Strategy\KebabCaseStrategy;
use Tale\Inflector\Strategy\LowerCamelCaseStrategy;
use Tale\Inflector\Strategy\MacroCaseStrategy;
use Tale\Inflector\Strategy\OrdinalStrategy;
use Tale\Inflector\Strategy\PluralStrategy;
use Tale\Inflector\Strategy\SingularStrategy;
use Tale\Inflector\Strategy\SnakeCaseStrategy;
use Tale\Inflector\Strategy\UnderscoreStrategy;
use Tale\Inflector\Strategy\UppercaseWordsStrategy;
use Tale\Inflector\StrategyFactory;
use Tale\Test\Inflector\Strategy\TestStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\StrategyFactory
 */
class StrategyFactoryTest extends TestCase
{
    /**
     * @covers ::getNamedStrategies
     * @covers ::validateClassName
     */
    public function testConstruct()
    {
        $instance = new StrategyFactory();
        $this->assertEquals([
            StrategyFactory::STRATEGY_CAMELIZE => CamelCaseStrategy::class,
            StrategyFactory::STRATEGY_DASHERIZE => DashStrategy::class,
            StrategyFactory::STRATEGY_CANONICALIZE => KebabCaseStrategy::class,
            StrategyFactory::STRATEGY_VARIABLEIZE => LowerCamelCaseStrategy::class,
            StrategyFactory::STRATEGY_CONSTANTIZE => MacroCaseStrategy::class,
            StrategyFactory::STRATEGY_TABLEIZE => SnakeCaseStrategy::class,
            StrategyFactory::STRATEGY_UNDERSCORIZE => UnderscoreStrategy::class,
            StrategyFactory::STRATEGY_HUMANIZE => UppercaseWordsStrategy::class,
            StrategyFactory::STRATEGY_PLURALIZE => PluralStrategy::class,
            StrategyFactory::STRATEGY_SINGULARIZE => SingularStrategy::class,
            StrategyFactory::STRATEGY_ORDINALIZE => OrdinalStrategy::class
        ], $instance->getNamedStrategies());
    }

    /**
     * @covers ::addNamedStrategy
     * @covers ::validateClassName
     */
    public function testInvalidClassNameThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $instance = new StrategyFactory();
        $instance->addNamedStrategy('test', stdClass::class);
    }

    /**
     * @covers ::addNamedStrategy
     * @covers ::validateClassName
     */
    public function testAddNamedStrategy()
    {
        $instance = new StrategyFactory();
        $instance->addNamedStrategy('test', TestStrategy::class);

        $namedStrategies = $instance->getNamedStrategies();
        $this->assertArrayHasKey('test', $namedStrategies);
        $this->assertEquals(TestStrategy::class, $namedStrategies['test']);
    }

    /**
     * @covers ::addNamedStrategies
     * @covers ::getNamedStrategies
     * @covers ::validateClassName
     */
    public function testAddNamedStrategies()
    {
        $instance = new StrategyFactory();
        $instance->addNamedStrategies([
            'test' => TestStrategy::class,
            'some_alias' => UppercaseWordsStrategy::class
        ]);

        $namedStrategies = $instance->getNamedStrategies();
        $this->assertArrayHasKey('test', $namedStrategies);
        $this->assertArrayHasKey('some_alias', $namedStrategies);
        $this->assertEquals(TestStrategy::class, $namedStrategies['test']);
        $this->assertEquals(UppercaseWordsStrategy::class, $namedStrategies['some_alias']);
    }

    /**
     * @covers ::resolve
     * @covers ::validateClassName
     */
    public function testResolve()
    {
        $instance = new StrategyFactory();
        $instance->addNamedStrategy('test', TestStrategy::class);

        $this->assertEquals(TestStrategy::class, $instance->resolve(TestStrategy::class));
        $this->assertEquals(TestStrategy::class, $instance->resolve('test'));
        $this->assertEquals(UppercaseWordsStrategy::class, $instance->resolve('humanize'));
        $this->assertEquals(PluralStrategy::class, $instance->resolve(PluralStrategy::class));
        $this->assertEquals(DashStrategy::class, $instance->resolve(StrategyFactory::STRATEGY_DASHERIZE));
    }

    /**
     * @covers ::get
     * @covers ::validateClassName
     */
    public function testGet()
    {
        $instance = new StrategyFactory();
        $instance->addNamedStrategy('test', TestStrategy::class);

        $this->assertInstanceOf(TestStrategy::class, $instance->get(TestStrategy::class));
        $this->assertInstanceOf(TestStrategy::class, $instance->get('test'));
        $this->assertInstanceOf(UppercaseWordsStrategy::class, $instance->get('humanize'));
        $this->assertInstanceOf(PluralStrategy::class, $instance->get(PluralStrategy::class));
        $this->assertInstanceOf(DashStrategy::class, $instance->get(StrategyFactory::STRATEGY_DASHERIZE));
    }
}
