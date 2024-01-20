<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class ListUsersRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'list-users',
        'roles' => null,
    ];

    protected array $decode = [
    ];

    protected array $urlParameters = [
    ];

    public function rules(): array
    {
        return [
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
