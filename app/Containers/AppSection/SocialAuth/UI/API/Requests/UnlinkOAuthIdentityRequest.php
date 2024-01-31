<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use Apiato\Core\Abstracts\Requests\Request;

final class UnlinkOAuthIdentityRequest extends Request
{
    public function rules(): array
    {
        return [
            'social_id' => ['required', 'string'],
        ];
    }
}
