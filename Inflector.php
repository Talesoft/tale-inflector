<?php

namespace Tale;


/**
 * Static string inflection utility
 *
 * First argument should consistently be a string
 *
 * @package Tale
 */
class Inflector
{

    /**
     * Array of uncountable english words.
     *
     * @var array
     */
    private static $uncountables = [
        'equipment',
        'information',
        'rice',
        'money',
        'species',
        'series',
        'fish',
        'sheep'
    ];

    /**
     * Array of irregular english words.
     *
     * Keys are singular, values are plural representations
     *
     * @var array
     */
    private static $irregulars = [
        'person' => 'people',
        'man'    => 'men',
        'child'  => 'children',
        'sex'    => 'sexes',
        'move'   => 'moves'
    ];

    /**
     * An array of plural translation patterns.
     *
     * Keys are RegEx patterns, values are replacements
     *
     * @var array
     */
    private static $plurals = [
        '/(quiz)$/i'               => '$1zes',
        '/^(ox)$/i'                => '$1en',
        '/([m|l])ouse$/i'          => '$1ice',
        '/(matr|vert|ind)ix|ex$/i' => '$1ices',
        '/(x|ch|ss|sh)$/i'         => '$1es',
        '/([^aeiouy]|qu)ies$/i'    => '$1y',
        '/([^aeiouy]|qu)y$/i'      => '$1ies',
        '/(hive)$/i'               => '$1s',
        '/(?:([^f])fe|([lr])f)$/i' => '$1$2ves',
        '/sis$/i'                  => 'ses',
        '/([ti])um$/i'             => '$1a',
        '/(buffal|tomat)o$/i'      => '$1oes',
        '/(bu)s$/i'                => '$1ses',
        '/(alias|status)/i'        => '$1es',
        '/(octop|vir)us$/i'        => '$1i',
        '/(ax|test)is$/i'          => '$1es',
        '/s$/i'                    => 's',
        '/$/'                      => 's'
    ];

    /**
     * An array of singular translation patterns.
     *
     * Keys are RegEx patterns, values are replacements
     *
     * @var array
     */
    private static $singulars = [
        '/(quiz)zes$/i'                                                    => '\1',
        '/(matr)ices$/i'                                                   => '\1ix',
        '/(vert|ind)ices$/i'                                               => '\1ex',
        '/^(ox)en/i'                                                       => '\1',
        '/(alias|status)es$/i'                                             => '\1',
        '/([octop|vir])i$/i'                                               => '\1us',
        '/(cris|ax|test)es$/i'                                             => '\1is',
        '/(shoe)s$/i'                                                      => '\1',
        '/(o)es$/i'                                                        => '\1',
        '/(bus)es$/i'                                                      => '\1',
        '/([m|l])ice$/i'                                                   => '\1ouse',
        '/(x|ch|ss|sh)es$/i'                                               => '\1',
        '/(m)ovies$/i'                                                     => '\1ovie',
        '/(s)eries$/i'                                                     => '\1eries',
        '/([^aeiouy]|qu)ies$/i'                                            => '\1y',
        '/([lr])ves$/i'                                                    => '\1f',
        '/(tive)s$/i'                                                      => '\1',
        '/(hive)s$/i'                                                      => '\1',
        '/([^f])ves$/i'                                                    => '\1fe',
        '/(^analy)ses$/i'                                                  => '\1sis',
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
        '/([ti])a$/i'                                                      => '\1um',
        '/(n)ews$/i'                                                       => '\1ews',
        '/s$/i'                                                            => '',
    ];

    /**
     * Array of english stop words for canonicalization.
     *
     * @var array
     */
    private static $stopWords = [
        'a',
        'about',
        'above',
        'across',
        'after',
        'afterwards',
        'again',
        'against',
        'all',
        'almost',
        'alone',
        'along',
        'already',
        'also',
        'although',
        'always',
        'am',
        'among',
        'amongst',
        'amoungst',
        'amount',
        'an',
        'and',
        'another',
        'any',
        'anyhow',
        'anyone',
        'anything',
        'anyway',
        'anywhere',
        'are',
        'around',
        'as',
        'at',
        'back',
        'be',
        'became',
        'because',
        'become',
        'becomes',
        'becoming',
        'been',
        'before',
        'beforehand',
        'behind',
        'being',
        'below',
        'beside',
        'besides',
        'between',
        'beyond',
        'bill',
        'both',
        'bottom',
        'but',
        'by',
        'call',
        'can',
        'cannot',
        'cant',
        'co',
        'computer',
        'con',
        'could',
        'couldnt',
        'cry',
        'de',
        'describe',
        'detail',
        'do',
        'done',
        'down',
        'due',
        'during',
        'each',
        'eg',
        'eight',
        'either',
        'eleven',
        'else',
        'elsewhere',
        'empty',
        'enough',
        'etc',
        'even',
        'ever',
        'every',
        'everyone',
        'everything',
        'everywhere',
        'except',
        'few',
        'fifteen',
        'fify',
        'fill',
        'find',
        'fire',
        'first',
        'five',
        'for',
        'former',
        'formerly',
        'forty',
        'found',
        'four',
        'from',
        'front',
        'full',
        'further',
        'get',
        'give',
        'go',
        'had',
        'has',
        'hasnt',
        'have',
        'he',
        'hence',
        'her',
        'here',
        'hereafter',
        'hereby',
        'herein',
        'hereupon',
        'hers',
        'herse"',
        'him',
        'himse"',
        'his',
        'how',
        'however',
        'hundred',
        'i',
        'ie',
        'if',
        'in',
        'inc',
        'indeed',
        'interest',
        'into',
        'is',
        'it',
        'its',
        'itse"',
        'keep',
        'last',
        'latter',
        'latterly',
        'least',
        'less',
        'ltd',
        'made',
        'many',
        'may',
        'me',
        'meanwhile',
        'might',
        'mill',
        'mine',
        'more',
        'moreover',
        'most',
        'mostly',
        'move',
        'much',
        'must',
        'my',
        'myse"',
        'name',
        'namely',
        'neither',
        'never',
        'nevertheless',
        'next',
        'nine',
        'no',
        'nobody',
        'none',
        'noone',
        'nor',
        'not',
        'nothing',
        'now',
        'nowhere',
        'of',
        'off',
        'often',
        'on',
        'once',
        'one',
        'only',
        'onto',
        'or',
        'other',
        'others',
        'otherwise',
        'our',
        'ours',
        'ourselves',
        'out',
        'over',
        'own',
        'part',
        'per',
        'perhaps',
        'please',
        'put',
        'rather',
        're',
        'same',
        'see',
        'seem',
        'seemed',
        'seeming',
        'seems',
        'serious',
        'several',
        'she',
        'should',
        'show',
        'side',
        'since',
        'sincere',
        'six',
        'sixty',
        'so',
        'some',
        'somehow',
        'someone',
        'something',
        'sometime',
        'sometimes',
        'somewhere',
        'still',
        'such',
        'system',
        'take',
        'ten',
        'than',
        'that',
        'the',
        'their',
        'them',
        'themselves',
        'then',
        'thence',
        'there',
        'thereafter',
        'thereby',
        'therefore',
        'therein',
        'thereupon',
        'these',
        'they',
        'thick',
        'thin',
        'third',
        'this',
        'those',
        'though',
        'three',
        'through',
        'throughout',
        'thru',
        'thus',
        'to',
        'together',
        'too',
        'top',
        'toward',
        'towards',
        'twelve',
        'twenty',
        'two',
        'un',
        'under',
        'until',
        'up',
        'upon',
        'us',
        'very',
        'via',
        'was',
        'we',
        'well',
        'were',
        'what',
        'whatever',
        'when',
        'whence',
        'whenever',
        'where',
        'whereafter',
        'whereas',
        'whereby',
        'wherein',
        'whereupon',
        'wherever',
        'whether',
        'which',
        'while',
        'whither',
        'who',
        'whoever',
        'whole',
        'whom',
        'whose',
        'why',
        'will',
        'with',
        'within',
        'without',
        'would',
        'yet',
        'you',
        'your',
        'yours',
        'yourself',
        'yourselves'
    ];

    /**
     * Returns the plural representation of a singular string.
     *
     * e.g. car => cars, house => houses, user-group => user-groups
     *
     * @param string $string The singular string to be translated
     *
     * @return string The plural representation of the passed singular string
     */
    public static function pluralize($string)
    {

        $lowerCased = strtolower($string);

        foreach (self::$uncountables as $uncountable)
            if (substr($lowerCased, (-1 * strlen($uncountable))) == $uncountable)
                return $string;

        foreach (self::$irregulars as $singular => $plural)
            if (preg_match('/('.$singular.')$/i', $string, $matches))
                return preg_replace('/('.$singular.')$/i', substr($matches[0], 0, 1).substr($plural, 1), $string);


        foreach (self::$plurals as $rule => $replacement)
            if (preg_match($rule, $string))
                return preg_replace($rule, $replacement, $string);

        return $string;
    }

    /**
     * Returns the singular representation of a plural string.
     *
     * e.g. cars => car, houses => house, user-groups => user-group
     *
     * @param string $string The plural string to be translated
     *
     * @return string The singular representation of the passed singular string
     */
    public static function singularize($string)
    {

        $lowerCased = strtolower($string);

        foreach (self::$uncountables as $uncountable)
            if (substr($lowerCased, (-1 * strlen($uncountable))) == $uncountable)
                return $string;

        foreach (self::$irregulars as $singular => $plural)
            if (preg_match('/('.$plural.')$/i', $string, $matches))
                return preg_replace('/('.$plural.')$/i', substr($matches[0], 0, 1).substr($singular, 1), $string);


        foreach (self::$singulars as $rule => $replacement)
            if (preg_match($rule, $string))
                return preg_replace($rule, $replacement, $string);

        return $string;
    }

    /**
     * Splits a string by logical parts and re-joins the parts with a delimeter.
     *
     * Takes a string, explodes it at any point except for alpha-numerical characters
     * (splitting it into single words)
     * and re-joins it with a different delimeter (Default: Space ( ))
     *
     * e.g. MyAwesomeClass      => My Awesome Class
     *      some_table_name     => some table name
     *      CONTENT_TYPE (-)    => CONTENT-TYPE
     *
     * @param string      $string    The subject string to be re-joined
     * @param string      $delimiter The delimeter to re-join single words with
     * @param string|null $ignore    Characters to ignore
     *
     * @return string The re-joined string
     */
    public static function reJoin($string, $delimiter = null, $ignore = null)
    {

        $delimiter = !is_null($delimiter) ? $delimiter : ' ';
        $ignore = $ignore ? preg_quote($ignore, '/') : '';

        //All non-alphanumeric characters
        $string = preg_replace(['/[^a-z0-9'.$ignore.']/i'], $delimiter, $string);

        //Between lowercase and UPPERCASE, e.g. some|Camel|Case|String
        //or uppercase notations, abbrevations etc., e.g. Xml|HTTP|Request
        $string = preg_replace(
            ['/([a-z0-9])([A-Z])/', '/([A-Z]+)([A-Z][a-z])/'],
            '$1'.$delimiter.'$2',
            $string
        );

        //finally remove repeating chars, so "something & something" wont end in "something---something"
        return preg_replace('/'.$delimiter.'+/', $delimiter, $string);
    }

    /**
     * Returns a "Human Readable" representation of a string.
     *
     * (Basically, reJoin paired with ucwords)
     *
     * e.g. SomeClassName   => Some Class Name
     *      some_table_name => Some Table Name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The "Human Readable" string
     */
    public static function humanize($string, $ignore = null)
    {

        return ucwords(strtolower(self::reJoin($string, ' ', $ignore)));
    }

    /**
     * Returns a CamelCased representation of a string.
     *
     * (Basically, humanize without the spaces between)
     *
     * Works best for inflecting strings to class-names
     *
     * e.g. Some String     => SomeString
     *      some_table_name => SomeTableName
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The CamelCased string
     */
    public static function camelize($string, $ignore = null)
    {

        return str_replace(' ', '', self::humanize($string, $ignore));
    }

    /**
     * Returns a dash-separated representation of a string.
     *
     * (Normal reJoin with "-"-delimiter)
     * The casing returned is the same as the input string
     *
     * e.g. SomeClassName   => Some-Class-Name
     *      some_table_name => some-table-name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The dash-separated string
     */
    public static function dasherize($string, $ignore = null)
    {

        return self::reJoin($string, '-', $ignore);
    }

    /**
     * Returns a underscore_separated representation of a string.
     *
     * (Normal reJoin with "_"-delimiter)
     * The casing returned is the same as the input string
     *
     * e.g. SomeClassName   => Some_Class_Name
     *      some-view-name  => some_view_name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The underscore_separated string
     */
    public static function underscorize($string, $ignore = null)
    {

        return self::rejoin($string, '_', $ignore);
    }

    /**
     * Returns a camelCased string with the first word lowercased.
     *
     * (Basically, camelize paired with lcfirst)
     *
     * Works best for inflecting strings to variable- or method-names
     *
     * e.g. SomeClassName   => someClassName
     *      some_table_name => someTableName
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The camelCased string
     */
    public static function variablize($string, $ignore = null)
    {

        return lcfirst(self::camelize($string, $ignore));
    }

    /**
     * Returns a lower_cased_dash_separated string.
     *
     * (Basically, underscorize paired with strtolower)
     *
     * Works best for inflecting strings to table-names in RDBMS
     *
     * e.g. SomeClassName   => some_class_name
     *      some-view-name  => some_view_name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The lower_cased_dash_separated string
     */
    public static function tableize($string, $ignore = null)
    {

        return strtolower(self::underscorize($string, $ignore));
    }

    /**
     * Returns a lower-cased-dash-separated string.
     *
     * (Basically, dasherize paired with strtolower)
     *
     * Works best for inflecting strings to file-names or slugs/mnemonic strings
     *
     * e.g. SomeClassName   => some-class-name
     *      some_table_name => some-table-name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The lower-cased-dash-separated string
     */
    public static function canonicalize($string, $ignore = null)
    {

        return strtolower(self::dasherize($string, $ignore));
    }

    /**
     * Returns a lower-cased-dash-separated string.
     *
     * This method automatically removes english stop-words from the string
     *
     * For a list of stop-words see $_stopWords
     *
     * Works best for inflecting strings to SEO-slugs
     *
     * e.g. SomeClassName   => class-name
     *      some_table_name => table-name
     *
     * @param string      $string The subject string
     * @param string|null $ignore Characters to ignore in re-joinment
     *
     * @return string The lower-cased-dash-separated string
     */
    public static function slugify($string, $ignore = null)
    {

        $string = self::canonicalize($string, $ignore);
        $stopWords = self::$stopWords;
        $string = implode('-', array_filter(explode('-', $string), function ($val) use ($stopWords) {

            return !in_array($val, $stopWords);
        }));

        return $string;
    }

    /**
     * Creates a rd, nd, th representation of a number
     *
     * e.g. 1    => 1st
     *      2    => 2nd
     *      3    => 3rd
     *      4    => 4th
     *      123  => 123rd
     *
     * @param string|int $string The input number or number-string
     *
     * @return string       The ordinalized representation of the input number
     */
    public static function ordinalize($string)
    {

        $number = intval($string);
        if (in_array($number % 100, [11, 12, 13]))
            return $number.'th';

        switch ($number % 10) {
            case 1:
                return $number.'st';
            case 2:
                return $number.'nd';
            case 3:
                return $number.'rd';
            default:
                return $number.'th';
        }
    }
}