<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Requests;

use Apiato\Core\Abstracts\Requests\Request;

final class CallbackRequest extends Request
{
    public function rules(): array
    {
        return [
            'state' => ['required', 'string'],
            'code' => ['required', 'string'],
        ];
    }
}
