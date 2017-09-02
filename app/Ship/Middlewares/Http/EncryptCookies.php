<?php

namespace App\Ship\Middlewares\Http;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Class EncryptCookies
 *
 * A.K.A app/Http/Middleware/EncryptCookies.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EncryptCookies extends Middleware
{

    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

}
