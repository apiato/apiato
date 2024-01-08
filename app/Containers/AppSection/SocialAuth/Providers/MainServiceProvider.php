<?php

namespace App\Containers\AppSection\SocialAuth\Providers;

use Apiato\Core\Abstracts\Providers\MainServiceProvider as ParentServiceProvider;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

final class MainServiceProvider extends ParentServiceProvider
{
    public array $serviceProviders = [];

    public array $aliases = [];

    public function register(): void
    {
        parent::register();

        $this->app->bind(RepositoryInterface::class, fn (): BaseRepository => $this->app->make(config('vendor-socialAuth.user.repository')));
    }
}
