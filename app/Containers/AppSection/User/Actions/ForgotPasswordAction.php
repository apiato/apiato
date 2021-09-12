<?php

namespace App\Containers\AppSection\User\Actions;

use App\Containers\AppSection\User\Mails\UserForgotPasswordMail;
use App\Containers\AppSection\User\Tasks\CreatePasswordResetTask;
use App\Containers\AppSection\User\Tasks\FindUserByEmailTask;
use App\Containers\AppSection\User\UI\API\Requests\ForgotPasswordRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordAction extends Action
{
    /**
     * @throws NotFoundException
     */
    public function run(ForgotPasswordRequest $request): void
    {
        $user = app(FindUserByEmailTask::class)->run($request->email);
        $token = app(CreatePasswordResetTask::class)->run($user);
        $resetUrl = $request->reseturl;

        if (!$this->endpointIsAllowed($resetUrl)) {
            throw new NotFoundException("The URL is not allowed ($resetUrl)");
        }

        Mail::send(new UserForgotPasswordMail($user, $token, $resetUrl));
    }

    private function endpointIsAllowed(mixed $resetUrl): bool
    {
        return in_array($this->getLastSegmentOfTheURL($resetUrl), config('appSection-user.allowed-reset-password-urls'), true);
    }

    private function getLastSegmentOfTheURL(string $resetUrl): string
    {
        $url = explode('/', $resetUrl);
        return $url[count($url) - 1];
    }
}
