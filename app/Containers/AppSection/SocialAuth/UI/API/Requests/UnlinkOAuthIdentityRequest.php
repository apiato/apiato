<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

final class UnlinkOAuthIdentityRequest extends Request
{
    public function rules(): array
    {
        return [
            'social_id' => 'string',
        ];
    }
}
