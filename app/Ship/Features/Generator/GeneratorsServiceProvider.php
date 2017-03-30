<?php

namespace App\Ship\Features\Generator;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerGenerators([
            'Action',
            'Route',
        ]);
    }

    /**
     * Register the generators.
     */
    private function registerGenerators(array $classes)
    {
        foreach ($classes as $class) {
            $lowerClass = strtolower($class);

            $this->app->singleton("command.porto.$lowerClass", function ($app) use ($class) {
                return $app['App\Ship\Features\Generator\Commands\\' . $class . 'Generator'];
            });

            $this->commands("command.porto.$lowerClass");
        }

    }

}
