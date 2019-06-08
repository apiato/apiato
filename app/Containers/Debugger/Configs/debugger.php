<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Requests Debugger Settings
    |--------------------------------------------------------------------------
    */

    'requests' => [

        /*
        |--------------------------------------------------------------------------
        | Requests Debugger
        |--------------------------------------------------------------------------
        |
        | Enable/Disable requests debugger.
        |
        */

        'debug' => env('REQUESTS_DEBUG', false),

        /*
         |--------------------------------------------------------------------------
         | Log File
         |--------------------------------------------------------------------------
         |
         | What to name the log file in the `storage/log` path.
         |
         */

        'log_file' => 'debugger.log',

        /*
        |--------------------------------------------------------------------------
        | Reduce the Log file
        |--------------------------------------------------------------------------
        |
        | Show only certain number of characters from each of these printed results.
        |
        */
        'response_show_first' => '700',

        'token_show_first' => '80',

    ],

    /*
    |--------------------------------------------------------------------------
    | Queries Debugger Settings
    |--------------------------------------------------------------------------
    */

    'queries' => [

        /*
        |--------------------------------------------------------------------------
        | Queries Debugger
        |--------------------------------------------------------------------------
        |
        | Enable/Disable queries debugger.
        |
        */

        'debug' => env('QUERIES_DEBUG', false),

        /*
         |--------------------------------------------------------------------------
         | Output
         |--------------------------------------------------------------------------
         |
         | Where to print the results. Log for the default Application Log file.
         | And Console to print on the current terminal session, in case running
         | your tests.
         |
         */

        'output' => [

            'log' => true,

            'console' => true,
        ]

    ]

];
