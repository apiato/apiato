<?php

namespace App\Ship\Middlewares\Http;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

/**
 * Class TrimStrings
 *
 * A.K.A app/Http/Middleware/TrimStrings.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class TrimStrings extends Middleware
{

    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];

}
