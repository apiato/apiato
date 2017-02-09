<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Executable
    |--------------------------------------------------------------------------
    |
    | if you get `apidoc not found` try pointing to your executable
    | Example: replace `apidoc` with `$(npm bin)/apidoc` if using NPM.
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
