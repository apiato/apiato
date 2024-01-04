<?php

namespace App\Containers\AppSection\SocialAuth\Tasks;

use Apiato\Core\Abstracts\Tasks\Task;
use App\Containers\AppSection\SocialAuth\Exceptions\AccountFailedException;
use Exception;

class CreateUserBySocialProfileTask extends Task
{
    private mixed $repository;

    public function __construct()
    {
        $this->repository = app(config('vendor-socialAuth.user.repository'));
    }

    /**
     * @throws Exception
     * @throws AccountFailedException
     */
    public function run(
        $provider,
        $token = null,
        $socialId = null,
        $nickname = null,
        $name = null,
        $email = null,
        $avatar = null,
        $tokenSecret = null,
        $expiresIn = null,
        $refreshToken = null,
        $avatar_original = null,
        $isAdmin = false
    ) {
        $data = [
            'social_provider' => $provider,
            'social_token' => $token,
            'social_refresh_token' => $refreshToken,
            'social_token_secret' => $tokenSecret,
            'social_expires_in' => $expiresIn,
            'social_id' => $socialId,
            'social_nickname' => $nickname,
            'social_avatar' => $avatar,
            'social_avatar_original' => $avatar_original,
            'email' => $email,
            'name' => $name,
            'is_admin' => $isAdmin,
        ];

        try {
            $registeredUser = $this->repository->findByField('email', $data['email'])->first();

            if ($registeredUser) {
                $user = $this->repository->update($data, $registeredUser->id);
            } else {
                $user = $this->repository->create($data);
            }

            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        } catch (Exception) {
            throw (new AccountFailedException());
        }

        return $user;
    }
}
