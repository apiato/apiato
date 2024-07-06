<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;

final class RedirectRequest extends Request
{
    public function rules(): array
    {
        return [
            //            'action' => ['required', Rule::enum(AuthAction::class)],
        ];
    }
}
