<?php

namespace Amrghamrawy\MacroSearch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Amrghamrawy\MacroSearch\MacroSearch
 */
class MacroSearch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Amrghamrawy\MacroSearch\MacroSearch::class;
    }
}
