<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\GetOAuthUserTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Prettus\Validator\Exceptions\ValidatorException;

final class SignupAction extends Action
{
    public function __construct(
        private readonly GetOAuthUserTask $getOAuthUserTask,
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->getOAuthUserTask->run($provider);

        /* @var OAuthIdentity $identity */
        $identity = $this->oAuthIdentityRepository->updateOrCreate(
            [
                'provider' => $provider,
                'social_id' => $oAuthUser->id,
            ],
            [
                'email' => $oAuthUser->email,
                'nickname' => $oAuthUser->nickname,
                'name' => $oAuthUser->name,
                'avatar' => $oAuthUser->avatar,
                'token' => $oAuthUser->token,
                'refresh_token' => $oAuthUser->refreshToken,
                'expires_in' => $oAuthUser->expiresIn,
                'scopes' => json_encode($oAuthUser->approvedScopes, JSON_THROW_ON_ERROR),
            ],
        );

        if ($identity->user()->doesntExist()) {
            $user = $identity->user()->create([
                'email' => $oAuthUser->email,
            ]);
            $user->markEmailAsVerified();
            $identity->user()->associate($user);
            $identity->save();
        }

        return new SocialAuthOutcome($identity->user, $identity->user->createToken('social'));
    }
}
