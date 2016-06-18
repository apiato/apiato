<?php

namespace App\Containers\Core\Provider\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use App\Containers\Core\Provider\Traits\CoreServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use CoreServiceProviderTrait;
}
