<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\SingularStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\SingularStrategy
 */
class SingularStrategyTest extends TestCase
{
    /**
     * @covers \Tale\Inflector\Strategy\AbstractCountableStrategy::isUncountable
     * @covers ::getIrregularSingular
     * @covers ::getSingular
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new SingularStrategy();
        $this->assertEquals('15', $instance->inflect('15s'));
        $this->assertEquals('matrix', $instance->inflect('matrices'));
        $this->assertEquals('house', $instance->inflect('houses'));
        $this->assertEquals('red car', $instance->inflect('red cars'));
        $this->assertEquals('equipment', $instance->inflect('equipment'));
        $this->assertEquals('person', $instance->inflect('people'));
    }
}
