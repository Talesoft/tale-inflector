<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class SingularStrategy extends AbstractCountableStrategy
{
    protected const PATTERNS = [
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
    ];

    private function getIrregularSingular(string $string): ?string
    {

        foreach (static::IRREGULARS as $singular => $plural) {
            if (!preg_match('/(' . $plural . ')$/i', $string, $matches)) {
                continue;
            }
            return preg_replace('/(' . $plural . ')$/i', $matches[0][0] . substr($singular, 1), $string);
        }
        return null;
    }

    private function getSingular(string $string): ?string
    {
        foreach (static::PATTERNS as $rule => $replacement) {
            if (!preg_match($rule, $string)) {
                continue;
            }
            return preg_replace($rule, $replacement, $string);
        }
        return preg_replace('/s$/i', '', $string);
    }

    public function inflect(string $string): string
    {
        if ($this->isUncountable($string)) {
            return $string;
        }

        if (($irregularSingular = $this->getIrregularSingular($string)) !== null) {
            return $irregularSingular;
        }

        return $this->getSingular($string);
    }
}
