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
    | Documentations URL's
    |--------------------------------------------------------------------------
    |
    | Specify the URL's to access your API documentations.
    |
    */

    'public' => [
        'url' => 'api/documentation'
    ],

    'private' => [
        'url' => 'api/private/documentation'
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
