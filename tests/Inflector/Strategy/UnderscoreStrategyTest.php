<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\UnderscoreStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\UnderscoreStrategyTest
 */
class UnderscoreStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     */
    public function testInflections()
    {
        $instance = new UnderscoreStrategy();
        $this->assertEquals('some_Random_string', $instance->inflect('--some Random&string!'));
        $this->assertEquals('I_Random_STRING', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('Some_STRING_Of_Strings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('String_String', $instance->inflect('String! & ! String'));
    }
}
