<?php

namespace App\Containers\AppSection\SocialAuth;

use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\UI\API\Transformers\OAuthIdentityTransformer;
use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Webmozart\Assert\Assert;

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
     * The register user action.
     */
    public static string $registerUserAction = RegisterUserAction::class;

    /**
     * Indicates if SocialAuth routes should be registered.
     */
    public static bool $registersRoutes = true;

    /**
     * Indicates if SocialAuth should verify user email automatically.
     */
    public static bool $verifiesEmail = false;

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
    public static function user()
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
    public static function userTransformer()
    {
        return new static::$userTransformer();
    }

    /**
     * Set the oAuth identity model class name.
     */
    public static function useOAuthIdentityModel(string $oAuthIdentityModel): void
    {
        Assert::isAOf($oAuthIdentityModel, OAuthIdentity::class);

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
    public static function oAuthIdentity()
    {
        return new static::$oAuthIdentityModel();
    }

    /**
     * Set the register user action class name.
     */
    public static function useRegisterUserAction(string $action): void
    {
        static::$registerUserAction = $action;
    }

    /**
     * Get the register user action class name.
     */
    public static function registerUserActionClass(): string
    {
        return static::$registerUserAction;
    }

    /**
     * Get a new register user action instance.
     */
    public static function registerUserAction()
    {
        return app(static::registerUserActionClass());
    }

    /**
     * Configure SocialAuth to not register its routes.
     */
    public static function ignoreRoutes(): static
    {
        static::$registersRoutes = false;

        return new static();
    }

    /**
     * Configure SocialAuth to verify user email automatically.
     *
     * If social email matches an existing user email, the user will be verified.
     */
    public static function verifiesEmail(): static
    {
        Assert::isAOf(static::$userModel, MustVerifyEmail::class);

        static::$verifiesEmail = true;

        return new static();
    }
}
