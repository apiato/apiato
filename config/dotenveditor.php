<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12.05.16
 * Time: 07:24
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Path configuration
    |--------------------------------------------------------------------------
    |
    | Change the paths, so they fit your needs
    |
    */
    'pathToEnv'         =>  base_path() . '/.env',
    'backupPath'        =>  base_path() . '/resources/backups/dotenv-editor/', // Make sure, you have a "/" at the end

    /*
    |--------------------------------------------------------------------------
    | GUI-Settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the different parameter for the view, where you can edit
    | .env via a graphical interface.
    |
    | Comma-separate your different middlewares.
    |
    */

    // Activate or deactivate the graphical interface
    'activated'         => true,

    // Set the base-route. All requests start here
    'route'             =>  '/admin/environments',

    // middleware and middlewwaregroups. Add your own middleware if you want.
    'middleware'        => ['web.auth', 'role:admin'],
    'middlewareGroups'  => []
];
