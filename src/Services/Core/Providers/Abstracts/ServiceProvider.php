<?php

namespace Mega\Services\Core\Providers\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Mega\Services\Core\Providers\Traits\MasterServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use MasterServiceProviderTrait;
}
