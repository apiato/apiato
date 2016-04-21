<?php

namespace Mega\Services\Core\Framework\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Mega\Services\Core\Framework\Traits\MasterServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{
    use MasterServiceProviderTrait;
}
