<?php
declare(strict_types=1);

namespace Tale\Test\Inflector\Strategy;

use PHPUnit\Framework\TestCase;
use Tale\Inflector\Strategy\OrdinalStrategy;

/**
 * @coversDefaultClass \Tale\Inflector\Strategy\OrdinalStrategy
 */
class OrdinalStrategyTest extends TestCase
{
    /**
     * @covers ::inflect
     */
    public function testInflections()
    {
        $instance = new OrdinalStrategy();
        $this->assertEquals('not a number', $instance->inflect('not a number'));
        $this->assertEquals('1st', $instance->inflect('1'));
        $this->assertEquals('2nd', $instance->inflect('2'));
        $this->assertEquals('3rd', $instance->inflect('3'));
        $this->assertEquals('4th', $instance->inflect('4'));
        $this->assertEquals('5th', $instance->inflect('5'));
        $this->assertEquals('11th', $instance->inflect('11'));
        $this->assertEquals('12th', $instance->inflect('12'));
        $this->assertEquals('13th', $instance->inflect('13'));
        $this->assertEquals('14th', $instance->inflect('14'));
        $this->assertEquals('15th', $instance->inflect('15'));
        $this->assertEquals('21st', $instance->inflect('21'));
        $this->assertEquals('22nd', $instance->inflect('22'));
        $this->assertEquals('23rd', $instance->inflect('23'));
        $this->assertEquals('24th', $instance->inflect('24'));
        $this->assertEquals('25th', $instance->inflect('25'));
        $this->assertEquals('111th', $instance->inflect('111'));
        $this->assertEquals('112th', $instance->inflect('112'));
        $this->assertEquals('113th', $instance->inflect('113'));
        $this->assertEquals('114th', $instance->inflect('114'));
        $this->assertEquals('115th', $instance->inflect('115'));
        $this->assertEquals('121st', $instance->inflect('121'));
        $this->assertEquals('122nd', $instance->inflect('122'));
        $this->assertEquals('123rd', $instance->inflect('123'));
        $this->assertEquals('124th', $instance->inflect('124'));
        $this->assertEquals('125th', $instance->inflect('125'));
    }
}
