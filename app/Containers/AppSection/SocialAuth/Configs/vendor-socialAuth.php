<?php

return [

    /*
     * This container already provides 3 provider. You can implement and add your SocialAuthProvider here.
     *
     * The class you want to use as a SocialAuthProvider needs to implement the
     * `App\Containers\AppSection\SocialAuth\Contracts\SocialAuthProvider` contract.
     */
    'providers' => [
        'google' => App\Containers\AppSection\SocialAuth\SocialAuthProviders\GoogleSocialAuthProvider::class,
        'facebook' => App\Containers\AppSection\SocialAuth\SocialAuthProviders\FacebookSocialAuthProvider::class,
        'twitter' => App\Containers\AppSection\SocialAuth\SocialAuthProviders\TwitterSocialAuthProvider::class,
    ],

    /*
     * Social Authentication container depends on Apiato's default user repository and transformer but
     * if your user repository or transformer is different from Apiato's default, you can provide them here
     */
    'user' => [
        'repository' => App\Containers\AppSection\User\Data\Repositories\UserRepository::class,
        'transformer' => App\Containers\AppSection\User\UI\API\Transformers\UserTransformer::class,
        'table_name' => 'users',
    ],
];
