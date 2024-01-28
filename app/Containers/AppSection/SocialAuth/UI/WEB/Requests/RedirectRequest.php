<?php

namespace App\Containers\AppSection\SocialAuth\UI\WEB\Requests;

use Apiato\Core\Abstracts\Requests\Request;

final class RedirectRequest extends Request
{
    public function rules(): array
    {
        return [
//            'action' => ['required', Rule::enum(AuthAction::class)],
        ];
    }
}
