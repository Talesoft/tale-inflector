<?php

namespace Tale\Test;

use Tale\Inflector;

class InflectorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider reJoinProvider
     */
    public function testReJoin($expected, $string, $delimiter)
    {

        $this->assertEquals($expected, Inflector::reJoin($string, $delimiter), "$string ($delimiter)");
    }

    public function reJoinProvider()
    {

        return [
            ['SOME STRING', 'SOME_STRING', ' '],
            ['some string', 'some-string', ' '],
            ['Some STRING', 'Some&STRING', ' '],
            ['some String', 'someString', ' '],
            ['Some String', 'SomeString', ' '],
            ['SOME String', 'SOMEString', ' '],
            ['Some STRING', 'SomeSTRING', ' '],
            ['Xml HTTP Request', 'XmlHTTPRequest', ' '],
        ];
    }
}