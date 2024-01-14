<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use Apiato\Core\Abstracts\Requests\Request;
use App\Containers\AppSection\SocialAuth\Enums\AuthAction;
use Illuminate\Validation\Rule;

final class RedirectRequest extends Request
{
    public function rules(): array
    {
        return [
            'action' => ['required', Rule::enum(AuthAction::class)],
        ];
    }
}
