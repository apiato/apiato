<?php

namespace App\Ship\Parents\Providers;

use App\Ship\Engine\Loaders\MiddlewaresLoaderTrait;


/**
 * Class MiddlewareProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class MiddlewareProvider extends MainProvider
{

    use MiddlewaresLoaderTrait;
}
