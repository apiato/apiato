<?php

namespace Apiato\Core\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

class Apiato extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Apiato';
    }
}

