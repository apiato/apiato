<?php

namespace App\Containers\AppSection\SocialAuth\Providers;

use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\SocialAuth;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;

class MainServiceProvider extends ParentMainServiceProvider
{
    public array $serviceProviders = [];

    public array $aliases = [];

    public function register(): void
    {
        parent::register();

        SocialAuth::verifiesEmail();
        SocialAuth::useUserModel(User::class);
        SocialAuth::useUserTransformerEntity(UserTransformer::class);
        SocialAuth::useOAuthIdentityModel(OAuthIdentity::class);
    }
}
