<?php

return [
    'can_link_multiple_providers' => false,
    'can_unlink_providers' => false,
    'can_signup_without_email' => false,
    /*
     * Social Authentication container depends on Apiato's default user repository and transformer, but
     * if your user repository or transformer is different from Apiato's default, you can provide them here.
     */
    'user' => [
        'user_model' => App\Containers\AppSection\User\Models\User::class,
        'repository' => App\Containers\AppSection\User\Data\Repositories\UserRepository::class,
        'transformer' => App\Containers\AppSection\User\UI\API\Transformers\UserTransformer::class,
        'table_name' => 'oauth_identities',
    ],
];
