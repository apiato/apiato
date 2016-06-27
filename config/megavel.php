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
                
            ],
        ],

    ],

];
