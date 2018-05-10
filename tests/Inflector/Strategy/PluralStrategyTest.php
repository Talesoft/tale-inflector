<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\PluralStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\PluralStrategy
 */
class PluralStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\AbstractCountableStrategy::isUncountable
     * @covers ::getIrregularPlural
     * @covers ::getPlural
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new PluralStrategy();
        $this->assertEquals('15s', $instance->inflect('15'));
        $this->assertEquals('matrices', $instance->inflect('matrix'));
        $this->assertEquals('houses', $instance->inflect('house'));
        $this->assertEquals('red cars', $instance->inflect('red car'));
        $this->assertEquals('equipment', $instance->inflect('equipment'));
        $this->assertEquals('people', $instance->inflect('person'));
    }
}
