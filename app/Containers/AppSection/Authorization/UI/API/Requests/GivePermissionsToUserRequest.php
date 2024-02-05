<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class GivePermissionsToUserRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    protected array $decode = [
        'id',
        'permission_ids.*',
    ];

    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'permission_ids' => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
