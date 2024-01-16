<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use Apiato\Core\Abstracts\Requests\Request;

final class LoginByAccessTokenRequest extends Request
{
    public function rules(): array
    {
        return [
            'access_token' => ['required', 'string'],
        ];
    }
}
