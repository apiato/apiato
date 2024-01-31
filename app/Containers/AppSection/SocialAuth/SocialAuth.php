<?php

namespace App\Containers\AppSection\SocialAuth;

use App\Containers\AppSection\SocialAuth\UI\API\Transformers\OAuthIdentityTransformer;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;

class SocialAuth
{
    /**
     * The user class name.
     */
    public static string $userModel = User::class;

    /**
     * The user transformer class name.
     */
    public static string $userTransformer = UserTransformer::class;

    /**
     * The oAuth identity class name.
     */
    public static string $oAuthIdentityModel = OAuthIdentityTransformer::class;

    /**
     * Set the user model class name.
     */
    public static function useUserModel(string $userModel): void
    {
        static::$userModel = $userModel;
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
    public static function user(): User
    {
        return new static::$userModel();
    }

    /**
     * Set the user transformer entity class name.
     */
    public static function useUserTransformerEntity(string $userTransformer): void
    {
        static::$userTransformer = $userTransformer;
    }

    /**
     * Get the user transformer entity class name.
     */
    public static function userTransformerEntity(): string
    {
        return static::$userTransformer;
    }

    /**
     * Get a new user transformer entity instance.
     */
    public static function userTransformer(): UserTransformer
    {
        return new static::$userTransformer();
    }

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
