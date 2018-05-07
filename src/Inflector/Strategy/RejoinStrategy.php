<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

use Tale\Inflector\StrategyInterface;

class RejoinStrategy implements StrategyInterface
{
    protected const DELIMITER = ' ';
    protected const TRANSLITERATION_RULES = 'Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;';

    public function inflect(string $string): string
    {
        $quotedDelimiter = static::DELIMITER === '' ? '' : preg_quote(static::DELIMITER, '/');

        $inflectedString = $string;
        if (\function_exists('transliterator_transliterate')) {
            $inflectedString = transliterator_transliterate(
                static::TRANSLITERATION_RULES,
                $string
            );
        }

        //All non-alphanumeric characters
        $inflectedString = preg_replace(['/[^a-z0-9]/i'], static::DELIMITER, $inflectedString);

        //Between lowercase and UPPERCASE, e.g. some|Camel|Case|String
        //or uppercase notations, abbrevations etc., e.g. Xml|HTTP|Request
        $inflectedString = preg_replace(
            ['/([a-z0-9])([A-Z])/', '/([A-Z]+)([A-Z][a-z])/'],
            '$1'.static::DELIMITER.'$2',
            $inflectedString
        );

        //finally remove repeating chars, so "something & something" wont end in "something---something"
        return static::DELIMITER === ''
            ? $inflectedString
            : trim(preg_replace('/'.$quotedDelimiter.'+/', static::DELIMITER, $inflectedString), static::DELIMITER);
    }
}
