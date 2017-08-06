<?php

namespace App\Ship\Middlewares\Http;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

/**
 * Class EncryptCookies
 *
 * A.K.A app/Http/Middleware/EncryptCookies.php
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EncryptCookies extends BaseEncrypter
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
