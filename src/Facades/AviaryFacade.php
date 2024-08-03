<?php

namespace Cbenjafield\Aviary\Facades;

use Cbenjafield\Aviary\AviaryService;
use Illuminate\Support\Facades\Facade;

class AviaryFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return AviaryService::class;
    }
}