<?php

namespace App\Kernel\Provider\Abstracts;

use App\Kernel\Provider\Traits\AutoRegisterServiceProvidersTrait;
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
