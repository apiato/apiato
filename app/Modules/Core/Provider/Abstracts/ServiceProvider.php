<?php

namespace Hello\Modules\Core\Provider\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Hello\Modules\Core\Provider\Traits\CoreServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use CoreServiceProviderTrait;
}
