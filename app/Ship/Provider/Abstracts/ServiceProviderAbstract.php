<?php

namespace App\Ship\Provider\Abstracts;

use App\Ship\Loader\Loaders\AliasesLoaderTrait;
use App\Ship\Loader\Loaders\ProvidersLoaderTrait;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProviderAbstract.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ServiceProviderAbstract extends LaravelServiceProvider
{
    use ProvidersLoaderTrait;
    use AliasesLoaderTrait;
}
