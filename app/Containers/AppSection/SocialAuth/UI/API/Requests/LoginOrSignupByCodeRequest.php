<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use Illuminate\Validation\Rule;

final class LoginOrSignupByCodeRequest extends Request
{
    public function rules(): array
    {
        return [
            'code' => [
                'required_if:access_token,null',
                'string',
            ],
            'access_token' => [
                'required_if:code,null',
                'string',
            ],
            // TODO: Can be improved!
            // Maybe we can look into token and get the email from there and if it's not there,
            // Then we make the email required.
            'email' => ['email', 'unique:members,email'],
            'redirect_url' => ['string', Rule::in(config('appSection-socialAuth.allowed-redirect-urls'))],
        ];
    }
}
