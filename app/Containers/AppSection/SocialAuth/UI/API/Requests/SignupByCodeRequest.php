<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

final class SignupByCodeRequest extends Request
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string'],
        ];
    }
}
