<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\DashStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\DashStrategyTest
 */
class DashStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     */
    public function testInflections()
    {
        $instance = new DashStrategy();
        $this->assertEquals('some-Random-string', $instance->inflect('--some Random&string!'));
        $this->assertEquals('I-Random-STRING', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('Some-STRING-Of-Strings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('String-String', $instance->inflect('String! & ! String'));
    }
}
