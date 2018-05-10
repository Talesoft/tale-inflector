<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\LowerCamelCaseStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\LowerCamelCaseStrategy
 */
class LowerCamelCaseStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new LowerCamelCaseStrategy();
        $this->assertEquals('someRandomString', $instance->inflect('--some Random&string!'));
        $this->assertEquals('iRandomString', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('someStringOfStrings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('stringString', $instance->inflect('String! & ! String'));
    }
}
