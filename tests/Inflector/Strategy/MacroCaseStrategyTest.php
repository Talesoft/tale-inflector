<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\MacroCaseStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\MacroCaseStrategy
 */
class MacroCaseStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new MacroCaseStrategy();
        $this->assertEquals('SOME_RANDOM_STRING', $instance->inflect('--some Random&string!'));
        $this->assertEquals('I_RANDOM_STRING', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('SOME_STRING_OF_STRINGS', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('STRING_STRING', $instance->inflect('String! & ! String'));
    }
}
