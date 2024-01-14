<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Data\Repositories\OAuthIdentityRepository;
use App\Containers\AppSection\SocialAuth\Exceptions\NoLinkedOAuthIdentityFoundException;
use App\Containers\AppSection\SocialAuth\Models\OAuthIdentity;
use App\Containers\AppSection\SocialAuth\Tasks\GetOAuthUserTask;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthOutcome;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

final class LoginAction extends Action
{
    public function __construct(
        private readonly GetOAuthUserTask $getOAuthUserTask,
        private readonly OAuthIdentityRepository $oAuthIdentityRepository,
    ) {
    }

    /**
     * @throws NoLinkedOAuthIdentityFoundException
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider): SocialAuthOutcome
    {
        $oAuthUser = $this->getOAuthUserTask->run($provider);

        /* @var OAuthIdentity $identity */
        $identity = $this->oAuthIdentityRepository->findWhere([
            'provider' => $provider,
            'social_id' => $oAuthUser->id,
        ])->first();

        if (!$identity) {
            throw new NoLinkedOAuthIdentityFoundException();
        }

        $this->oAuthIdentityRepository->update([
            'email' => $oAuthUser->email,
            'nickname' => $oAuthUser->nickname,
            'name' => $oAuthUser->name,
            'avatar' => $oAuthUser->avatar,
            'token' => $oAuthUser->token,
            'refresh_token' => $oAuthUser->refreshToken,
            'expires_in' => $oAuthUser->expiresIn,
            'scopes' => json_encode($oAuthUser->approvedScopes, JSON_THROW_ON_ERROR),
        ], $identity->id);

        $user = $identity->user;
        if ($this->isEmailMatching($user, $oAuthUser) && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return new SocialAuthOutcome($identity);
    }

    private function isEmailMatching(mixed $user, User $oAuthUser): bool
    {
        return $user->email === $oAuthUser->email;
    }
}
