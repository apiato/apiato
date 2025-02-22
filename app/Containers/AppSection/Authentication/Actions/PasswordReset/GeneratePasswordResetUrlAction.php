<?php

namespace App\Containers\AppSection\Authentication\Actions\PasswordReset;

use App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset\ResetPasswordController;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Webmozart\Assert\Assert;

final class GeneratePasswordResetUrlAction extends ParentAction
{
    public function __invoke(User $notifiable, string $token): string
    {
        $appId = request()->header('App-Identifier', config('apiato.defaults.app'));
        Assert::keyExists(config('apiato.apps'), $appId, "App-Identifier header value '{$appId}' is not valid. Allowed values are: " . implode(', ', array_keys(config('apiato.apps'))));

        $frontendUrls = config("apiato.apps.{$appId}", []);
        $frontendUrl = $frontendUrls['url'];

        $verificationUrl = action(ResetPasswordController::class, [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return "{$frontendUrl}?reset_url=" . $verificationUrl;
    }
}
