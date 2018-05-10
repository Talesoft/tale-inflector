<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\SnakeCaseStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\SnakeCaseStrategy
 */
class SnakeCaseStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new SnakeCaseStrategy();
        $this->assertEquals('some_random_string', $instance->inflect('--some Random&string!'));
        $this->assertEquals('i_random_string', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('some_string_of_strings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('string_string', $instance->inflect('String! & ! String'));
    }
}
