<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class PluralStrategy extends AbstractCountableStrategy
{
    protected const PATTERNS = [
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
        '/s$/i'                    => 's'
    ];

    private function getIrregularPlural(string $string): ?string
    {
        foreach (static::IRREGULARS as $singular => $plural) {
            if (!preg_match('/(' . $singular . ')$/i', $string, $matches)) {
                continue;
            }
            return preg_replace('/(' . $singular . ')$/i', $matches[0][0] . substr($plural, 1), $string);
        }
        return null;
    }

    private function getPlural(string $string): ?string
    {
        foreach (static::PATTERNS as $rule => $replacement) {
            if (!preg_match($rule, $string)) {
                continue;
            }
            return preg_replace($rule, $replacement, $string);
        }
        return preg_replace('/$/', 's', $string);
    }

    public function inflect(string $string): string
    {
        if ($this->isUncountable($string)) {
            return $string;
        }

        if (($irregularPlural = $this->getIrregularPlural($string)) !== null) {
            return $irregularPlural;
        }

        return $this->getPlural($string);
    }
}
