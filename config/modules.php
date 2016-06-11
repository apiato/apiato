<?php

return [
    'modules' => [
        'namespace' => 'Hello',

        'register' => [
            'User' => [
                'routes'       => [
                    'api' => [
                        ['fileName' => 'v1', 'versionNumber' => '1']
                    ],
                    'web' => [
                        ['fileName' => 'main']
                    ],

                ],
                'dependencies' => [
                    'modules'  => [],
                    'services' => [
                        'Core',
                        'Authentication'
                    ],
                ],
            ],
        ],

    ],
];
