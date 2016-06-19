<?php

namespace App\Engine\Provider\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use App\Engine\Provider\Traits\EngineServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use EngineServiceProviderTrait;
}
