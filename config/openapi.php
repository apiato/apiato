<?php

use App\Ship\Documentation\Apiato;
use MohammadAlavi\LaravelOpenApi\Factories\ExampleFactory;

return [
    'collections' => [
        'private' => [
            'openapi' => Apiato::class,
        ],
        'public' => [
            'openapi' => Apiato::class,
        ],
        'default' => [
            'openapi' => ExampleFactory::class,
            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [
                'uri' => '/openapi',
                'middleware' => [],
            ],
            // Directories to use for locating OpenAPI object definitions.
            'components' => [
                'schemas' => [
                    app_path('OpenAPI/Schemas'),
                ],

                'responses' => [
                    app_path('OpenAPI/Responses'),
                ],

                'parameters' => [
                    app_path('OpenAPI/Parameters'),
                ],

                'examples' => [
                    app_path('OpenAPI/Examples'),
                ],

                'request_bodies' => [
                    app_path('OpenAPI/RequestBodies'),
                ],

                'headers' => [
                    app_path('OpenAPI/Headers'),
                ],

                'security_schemes' => [
                    app_path('OpenAPI/SecuritySchemes'),
                ],

                'links' => [
                    app_path('OpenAPI/Links'),
                ],

                'callbacks' => [
                    app_path('OpenAPI/Callbacks'),
                ],

                'path_items' => [
                    app_path('OpenAPI/PathItems'),
                ],
            ],
        ],
    ],
];
