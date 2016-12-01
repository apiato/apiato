<?php

namespace App\Port\Provider\Abstracts;

use App\Port\Alias\Loaders\AliasesLoaderTrait;
use App\Port\Provider\Loaders\ProvidersLoaderTrait;
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
