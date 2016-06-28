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
            | Container: User
            |--------------------------------------
            */
            'User' => [

                /*
                |--------------------------------------------------------------------------
                | User Container Routes
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
                | User Container Dependencies
                |--------------------------------------------------------------------------
                |
                | Here you should include the names of all the Container dependencies.
                | A Container could depend on another Container or on a Service.
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
             | Container: Email
             |--------------------------------------
             */
            'Email' => [

                'routes'                => [
                    'api' => [
                        ['fileName' => 'v1', 'versionNumber' => '1']
                    ],
                ],

                'dependencies'          => [
                    'containers'  => [

                    ],
                    'services' => [

                    ],
                ],
            ],

            /*
             |--------------------------------------
             | Container: Demo
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
