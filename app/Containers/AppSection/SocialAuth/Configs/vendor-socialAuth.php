<?php

return [
    // TODO: review and remove unused configs
    'can_link_multiple_providers' => false,
    'can_unlink_providers' => false,
    'can_signup_without_email' => false,

    /*
    |--------------------------------------------------------------------------
    | User Configs
    |--------------------------------------------------------------------------
    |
    | Social Authentication container depends on Apiato's default user repository and transformer, but
    | if your user repository or transformer is different from Apiato's default, you can provide them here.
    |
    */

    'user' => [
        'table_name' => 'oauth_identities',
    ],
];
