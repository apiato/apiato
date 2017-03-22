<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Executable
    |--------------------------------------------------------------------------
    |
    | Specify how you run or access the `apidoc` tool on your machine.
    |
    */

    'executable' => 'apidoc',

    /*
    |--------------------------------------------------------------------------
    | API Types
    |--------------------------------------------------------------------------
    |
    | Documentations of these types will be generated, automatically when
    | running the API Docs auto generator command.
    | IF you API doesn't support any of the types you can simply remove it
    | from the types array.
    |
    */

    'types' => [

        /*
        |--------------------------------------------------------------------------
        | Documentations URL's
        |--------------------------------------------------------------------------
        |
        | Specify the URL's to access your API documentations.
        |
        */

        'public' => [
            'url' => 'api/documentation',
        ],

        'private' => [
            'url' => 'api/private/documentation',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | HTML files
    |--------------------------------------------------------------------------
    |
    | Specify where to put the generated HTML files.
    |
    */

    'html_files' => 'public/'
];
