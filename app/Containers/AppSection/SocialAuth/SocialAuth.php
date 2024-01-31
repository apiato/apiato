<?php

namespace App\Containers\AppSection\SocialAuth;

use App\Containers\AppSection\SocialAuth\UI\API\Transformers\OAuthIdentityTransformer;

class SocialAuth
{
    public static string $oAuthIdentityModel = OAuthIdentityTransformer::class;

    /**
     * Set the oAuth identity model class name.
     */
    public static function useOAuthIdentityModel(string $oAuthIdentityModel): void
    {
        static::$oAuthIdentityModel = $oAuthIdentityModel;
    }

    /**
     * Get the oAuth identity model class name.
     */
    public static function oAuthIdentityModel(): string
    {
        return static::$oAuthIdentityModel;
    }

    /**
     * Get a new oAuth identity model instance.
     */
    public static function oAuthIdentity(): OAuthIdentityTransformer
    {
        return new static::$oAuthIdentityModel();
    }
}
