<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Data\Repositories\SocialAccountRepository;
use App\Containers\AppSection\SocialAuth\Exceptions\NoLinkedSocialAccountFoundException;
use App\Containers\AppSection\SocialAuth\Models\SocialAccount;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthResult;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

final class SocialLoginAction extends Action
{
    public function __construct(
        private readonly SocialAccountRepository $socialAccountRepository,
    ) {
    }

    /**
     * @throws NoLinkedSocialAccountFoundException
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider, User $oAuthUser): SocialAuthResult
    {
        /* @var SocialAccount $socialAccount */
        $socialAccount = $this->socialAccountRepository->findWhere([
            'provider' => $provider,
            'social_id' => $oAuthUser->id,
        ])->first();

        if (!$socialAccount) {
            throw new NoLinkedSocialAccountFoundException();
        }

        $this->socialAccountRepository->update([
            'email' => $oAuthUser->email,
            'nickname' => $oAuthUser->nickname,
            'name' => $oAuthUser->name,
            'avatar' => $oAuthUser->avatar,
            'token' => $oAuthUser->token,
            'refresh_token' => $oAuthUser->refreshToken,
            'expires_in' => $oAuthUser->expiresIn,
            'scopes' => json_encode($oAuthUser->approvedScopes, JSON_THROW_ON_ERROR),
        ], $socialAccount->id);

        $user = $socialAccount->user;
        if ($this->isEmailMatching($user, $oAuthUser) && !$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return new SocialAuthResult($user, $user->createToken('social'));
    }

    private function isEmailMatching(mixed $user, User $oAuthUser): bool
    {
        return $user->email === $oAuthUser->email;
    }
}
