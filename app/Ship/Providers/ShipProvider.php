<?php

namespace App\Ship\Providers;

use Apiato\Core\Abstracts\Models\Model;
use Apiato\Core\Traits\HashIdTrait;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class ShipProvider extends ParentMainServiceProvider
{
    /**
     * Register any Service Providers on the Ship layer (including third party packages).
     */
    public array $serviceProviders = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Register any Alias on the Ship layer (including third party packages).
     */
    protected array $aliases = [];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        /*
         * Load the ide-helper service provider only in non-production environments.
         */
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        Config::macro('unset', function (string $key): void {
            Arr::forget($this->items, $key);
        });

        /*
         * Check if the given id is in the given model collection by comparing hashed ids.
         *
         * @param Collection|array $ids either a collection of models or an array of unhashed ids
         */
        Collection::macro('inIds', function (string $hashedId): bool {
            $hashService = new class() extends Model {
                use HashIdTrait;
            };

            $id = $hashService->decode($hashedId);

            return $this->contains('id', $id);
        });
    }
}
