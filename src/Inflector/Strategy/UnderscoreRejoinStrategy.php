<?php
declare(strict_types=1);

namespace Tale\Inflector\Strategy;

class UnderscoreRejoinStrategy extends RejoinStrategy
{
    protected const DELIMITER = '_';
}