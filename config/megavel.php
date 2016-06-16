<?php

return [
    'modules' => [

        /*
        |--------------------------------------------------------------------------
        | Modules Namespace
        |--------------------------------------------------------------------------
        |
        | Here you should set the Modules namespace
        |
        */
        'namespace' => 'App',

        /*
        |--------------------------------------------------------------------------
        | Modules Registration
        |--------------------------------------------------------------------------
        |
        | Here you should register all your Modules
        |
        */
        'register'  => [

            /*
            |--------------------------------------
            | Module: User
            |--------------------------------------
            */
            'User' => [

                /*
                |--------------------------------------------------------------------------
                | User Module Routes
                |--------------------------------------------------------------------------
                |
                | Here you should define the routes files names. There are two types of
                | Routes, API Routes and Web Routes.
                | For the API routes you must define the route version number in addition
                | to the route file name.
                | For the Web routes you must only define the route file name.
                |
                */
                'routes'                => [
                    'api' => [
                        ['fileName' => 'v1', 'versionNumber' => '1']
                    ],
                    'web' => [
                        ['fileName' => 'main']
                    ],
                ],

                /*
                |--------------------------------------------------------------------------
                | User Module extra (additional) Service Providers
                |--------------------------------------------------------------------------
                |
                | Here you should register any extra service provider in your module.
                | By default every module must have a single (main) service provider,
                | which will get registered automatically by the core service provider,
                | without the need to define it here. However, if you have extra service
                | providers in your Module, you must register them here to get loaded.
                |
                */
                'extraServiceProviders' => [
                    App\Modules\User\Providers\AuthServiceProvider::class,
                ],

                /*
                |--------------------------------------------------------------------------
                | User Module Dependencies
                |--------------------------------------------------------------------------
                |
                | Here you should include the names of all the Module dependencies.
                | A Module could depend on another Module or on a Service.
                |
                */
                'dependencies'          => [
                    'modules' => [

                    ],

                    'services' => [
                        'ApiAuthentication',
                        'Authorization',
                    ],
                ],
            ],

            /*
             |--------------------------------------
             | Module: Demo
             |--------------------------------------
             */
            'Demo' => [

                /*
                |--------------------------------------------------------------------------
                | User Module Routes
                |--------------------------------------------------------------------------
                |
                | Here you should define the routes files names. There are two types of
                | Routes, API Routes and Web Routes.
                | For the API routes you must define the route version number in addition
                | to the route file name.
                | For the Web routes you must only define the route file name.
                |
                */
                'routes'                => [
                    'api' => [
                        ['fileName' => 'v1', 'versionNumber' => '1']
                    ],
                    'web' => [
                        ['fileName' => 'main']
                    ],
                ],

                /*
                |--------------------------------------------------------------------------
                | Demo Module Dependencies
                |--------------------------------------------------------------------------
                |
                | Here you should include the names of all the Module dependencies.
                | A Module could depend on another Module or on a Service.
                |
                */
                'dependencies'          => [
                    'modules'  => [

                    ],
                    'services' => [

                    ],
                ],

                /*
                |--------------------------------------------------------------------------
                | Demo Module extra (additional) Service Providers
                |--------------------------------------------------------------------------
                |
                | Usually you don't have to touche the Core Module.
                |
                | Here you should register any extra service provider in your module.
                | By default every module must have a single (main) service provider,
                | which will get registered automatically by the core service provider,
                | without the need to define it here. However, if you have extra service
                | providers in your Module, you must register them here to get loaded.
                |
                */
                'extraServiceProviders' => [
                    App\Modules\Demo\Events\EventServiceProvider::class,
                ],
            ],

            /*
            |--------------------------------------
            | Module: Core
            |--------------------------------------
            */
            'Core' => [

                /*
                |--------------------------------------------------------------------------
                | Core Module Dependencies
                |--------------------------------------------------------------------------
                |
                | Here you should include the names of all the Module dependencies.
                | A Module could depend on another Module or on a Service.
                |
                */
                'dependencies'          => [
                    'services' => [
                        'Configuration',
                    ],
                ],

                /*
                |--------------------------------------------------------------------------
                | Core Module extra (additional) Service Providers
                |--------------------------------------------------------------------------
                |
                | Usually you don't have to touche the Core Module.
                |
                | Here you should register any extra service provider in your module.
                | By default every module must have a single (main) service provider,
                | which will get registered automatically by the core service provider,
                | without the need to define it here. However, if you have extra service
                | providers in your Module, you must register them here to get loaded.
                |
                */
                'extraServiceProviders' => [
                    App\Modules\Core\Provider\Providers\RoutesServiceProvider::class,
                ],
            ],

        ],

    ],

];
