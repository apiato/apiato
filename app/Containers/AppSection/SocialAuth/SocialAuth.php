<?php

namespace App\Containers\AppSection\SocialAuth;

use App\Containers\AppSection\SocialAuth\UI\API\Transformers\OAuthIdentityTransformer;
use App\Containers\AppSection\User\Models\User;

class SocialAuth
{
    /**
     * The user class name.
     */
    public static string $userModel = User::class;

    /**
     * The oAuth identity class name.
     */
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

    /**
     * Set the user model class name.
     */
    public static function useUserModel(string $oAuthIdentityModel): void
    {
        static::$userModel = $oAuthIdentityModel;
    }

    /**
     * Get the user model class name.
     */
    public static function userModel(): string
    {
        return static::$userModel;
    }

    /**
     * Get a new user model instance.
     */
    public static function user(): OAuthIdentityTransformer
    {
        return new static::$userModel();
    }
}
