<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\CamelCaseStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\CamelCaseStrategy
 */
class CamelCaseStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new CamelCaseStrategy();
        $this->assertEquals('SomeRandomString', $instance->inflect('--some Random&string!'));
        $this->assertEquals('IRandomString', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('SomeStringOfStrings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('StringString', $instance->inflect('String! & ! String'));
    }
}
