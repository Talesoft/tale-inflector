<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\KebabCaseStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\KebabCaseStrategy
 */
class KebabCaseStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new KebabCaseStrategy();
        $this->assertEquals('some-random-string', $instance->inflect('--some Random&string!'));
        $this->assertEquals('i-random-string', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('some-string-of-strings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('string-string', $instance->inflect('String! & ! String'));
    }
}
