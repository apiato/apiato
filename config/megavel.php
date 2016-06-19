<?php

return [
    'containers' => [

        /*
        |--------------------------------------------------------------------------
        | Containers Namespace
        |--------------------------------------------------------------------------
        |
        | Here you should set the Containers namespace
        |
        */
        'namespace' => 'App',

        /*
        |--------------------------------------------------------------------------
        | Containers Registration
        |--------------------------------------------------------------------------
        |
        | Here you should register all your Containers
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
                | which will get registered automatically by the Engine service provider,
                | without the need to define it here. However, if you have extra service
                | providers in your Module, you must register them here to get loaded.
                |
                */
                'extraServiceProviders' => [
                    App\Containers\User\Providers\PoliciesServiceProvider::class,
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
                    'containers' => [

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
                    'containers'  => [

                    ],
                    'services' => [

                    ],
                ],

                /*
                |--------------------------------------------------------------------------
                | Demo Module extra (additional) Service Providers
                |--------------------------------------------------------------------------
                |
                | Usually you don't have to touche the Engine Module.
                |
                | Here you should register any extra service provider in your module.
                | By default every module must have a single (main) service provider,
                | which will get registered automatically by the Engine service provider,
                | without the need to define it here. However, if you have extra service
                | providers in your Module, you must register them here to get loaded.
                |
                */
                'extraServiceProviders' => [
                    App\Containers\Demo\Events\EventServiceProvider::class,
                ],
            ],
        ],

    ],

];
