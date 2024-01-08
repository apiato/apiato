<?php

namespace App\Containers\AppSection\SocialAuth\Actions;

use Apiato\Core\Abstracts\Actions\Action;
use App\Containers\AppSection\SocialAuth\Data\Repositories\SocialAccountRepository;
use App\Containers\AppSection\SocialAuth\Models\SocialAccount;
use App\Containers\AppSection\SocialAuth\Values\SocialAuthResult;
use Laravel\Socialite\Two\User;
use Prettus\Validator\Exceptions\ValidatorException;

final class SocialSignupAction extends Action
{
    public function __construct(
        private readonly SocialAccountRepository $socialAccountRepository,
    ) {
    }

    /**
     * @throws ValidatorException
     * @throws \JsonException
     */
    public function run(string $provider, User $oAuthUser): SocialAuthResult
    {
        /* @var SocialAccount $socialAccount */
        $socialAccount = $this->socialAccountRepository->updateOrCreate(
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

        if ($socialAccount->user()->doesntExist()) {
            $user = $socialAccount->user()->create([
                'email' => $oAuthUser->email,
            ]);
            $user->markEmailAsVerified();
            $socialAccount->user()->associate($user);
            $socialAccount->save();
        }

        return new SocialAuthResult($socialAccount->user, $socialAccount->user->createToken('social'));
    }
}
