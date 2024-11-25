<?php

namespace EnricoDeLazzari\XmlToArray\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EnricoDeLazzari\XmlToArray\XmlToArray
 */
class XmlToArray extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EnricoDeLazzari\XmlToArray\XmlToArray::class;
    }
}
