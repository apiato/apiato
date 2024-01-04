<?php

namespace App\Containers\AppSection\SocialAuth\UI\API\Requests;

use Apiato\Core\Abstracts\Requests\Request;

final class ApiAuthenticateRequest extends Request
{
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    protected array $decode = [
    ];

    protected array $urlParameters = [
        'provider',
    ];

    public function rules(): array
    {
        return [
            'oauth_token' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
