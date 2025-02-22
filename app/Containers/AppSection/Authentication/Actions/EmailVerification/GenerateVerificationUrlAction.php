<?php

namespace App\Containers\AppSection\Authentication\Actions\EmailVerification;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Webmozart\Assert\Assert;

final class GenerateVerificationUrlAction extends ParentAction
{
    public function __invoke(User $notifiable): string
    {
        $appId = request()->header('App-Identifier', config('apiato.defaults.app'));
        Assert::keyExists(config('apiato.apps'), $appId, "App-Identifier header value '{$appId}' is not valid. Allowed values are: " . implode(', ', array_keys(config('apiato.apps'))));

        $frontendUrls = config("apiato.apps.{$appId}", []);
        $frontendUrl = $frontendUrls['url'];

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getHashedKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ],
        );

        return "{$frontendUrl}?verification_url=" . $verificationUrl;
    }
}
