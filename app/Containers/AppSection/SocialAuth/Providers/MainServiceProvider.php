<?php

namespace App\Containers\AppSection\SocialAuth\Providers;

use Apiato\Core\Abstracts\Providers\MainServiceProvider as ParentServiceProvider;

final class MainServiceProvider extends ParentServiceProvider
{
    public array $serviceProviders = [];

    public array $aliases = [];

    public function register(): void
    {
        parent::register();
    }
}
