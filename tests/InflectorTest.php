<?php

namespace Tale\Test;

use PHPUnit\Framework\TestCase;
use Tale\Inflector;
use Tale\Inflector\StrategyFactory;

class InflectorTest extends TestCase
{
    private $values = ['Some test-String', 'XmlHTTPRequest', 'car', 'red-houses', '1', '2', '3', '4', '12', '23'];
    private $strategyExpectations = [
        StrategyFactory::STRATEGY_CAMELIZE => ['SomeTestString', 'XmlHttpRequest', 'Car', 'RedHouses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_DASHERIZE => ['Some-test-String', 'Xml-HTTP-Request', 'car', 'red-houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_CANONICALIZE => ['some-test-string', 'xml-http-request', 'car', 'red-houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_VARIABLEIZE => ['someTestString', 'xmlHttpRequest', 'car', 'redHouses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_CONSTANIZE => ['SOME_TEST_STRING', 'XML_HTTP_REQUEST', 'CAR', 'RED_HOUSES', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_TABLEIZE => ['some_test_string', 'xml_http_request', 'car', 'red_houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_UNDERSCORIZE => ['Some_test_String', 'Xml_HTTP_Request', 'car', 'red_houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_HUMANIZE => ['Some Test String', 'Xml Http Request', 'Car', 'Red Houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_PLURALIZE => ['Some test-Strings', 'XmlHTTPRequests', 'cars', 'red-houses', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_SINGULARIZE => ['Some test-String', 'XmlHTTPRequest', 'car', 'red-house', '1', '2', '3', '4', '12', '23'],
        StrategyFactory::STRATEGY_ORDINALIZE => ['Some test-String', 'XmlHTTPRequest', 'car', 'red-houses', '1st', '2nd', '3rd', '4th', '12th', '23rd']
    ];

    public function testInflection()
    {
        $inflector = new Inflector();
        foreach ($this->values as $i => $value) {
            foreach ($this->strategyExpectations as $strategy => $expectations) {
                $expectedValue = $expectations[$i];
                $this->assertEquals(
                    $expectedValue,
                    $inflector->inflect($value, [$strategy]),
                    "\"{$value}\" => {$strategy} => {$expectedValue}"
                );
            }
        }
    }
}
