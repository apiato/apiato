<?php

namespace App\Ship\Provider\Abstracts;

use App\Ship\Provider\Traits\AutoRegisterServiceProvidersTrait;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProviderAbstract.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProviderAbstract extends LaravelServiceProvider
{
    use AutoRegisterServiceProvidersTrait;
}
