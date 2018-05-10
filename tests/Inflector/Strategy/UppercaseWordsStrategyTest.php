<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\UppercaseWordsStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\UppercaseWordsStrategy
 */
class UppercaseWordsStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\RejoinStrategy::inflect
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new UppercaseWordsStrategy();
        $this->assertEquals('Some Random String', $instance->inflect('--some Random&string!'));
        $this->assertEquals('I Random String', $instance->inflect('IRandomSTRING'));
        $this->assertEquals('Some String Of Strings', $instance->inflect('SomeSTRINGOfStrings'));
        $this->assertEquals('String String', $instance->inflect('String! & ! String'));
    }
}
