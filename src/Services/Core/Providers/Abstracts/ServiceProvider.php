<?php

namespace Hello\Services\Core\Providers\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Hello\Services\Core\Providers\Traits\MasterServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use MasterServiceProviderTrait;
}
