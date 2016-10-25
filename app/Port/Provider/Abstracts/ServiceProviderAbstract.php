<?php

namespace App\Port\Provider\Abstracts;

use App\Port\Provider\Traits\ContainersServiceProviderTrait;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProviderAbstract.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProviderAbstract extends LaravelServiceProvider
{
    use ContainersServiceProviderTrait;
}
