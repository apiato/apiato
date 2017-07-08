<?php

namespace App\Ship\Generator;

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
        // TODO: these commands names should be collected from the directory, to remove the step of manual registration of commands.
        $this->registerGenerators([
            'Action',
            'Controller',
            'Exception',
            'Model',
            'Repository',
            'Request',
            'Route',
            'Task',
            'Transformer'
            // Register more generator commands here..
        ]);
    }

    /**
     * Register the generators.
     * @param array $classes
     */
    private function registerGenerators(array $classes)
    {
        foreach ($classes as $class) {
            $lowerClass = strtolower($class);

            $keyName = "command.porto.$lowerClass";
            
            $this->app->singleton($keyName, function ($app) use ($class) {
                return $app['App\Ship\Generator\Commands\\' . $class . 'Generator'];
            });

            $this->commands($keyName);
        }
    }
}
