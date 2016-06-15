<?php

namespace App\Modules\Core\Provider\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use App\Modules\Core\Provider\Traits\CoreServiceProviderTrait;

/**
 * Class ServiceProvider.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProvider extends LaravelServiceProvider
{

    use CoreServiceProviderTrait;
}
