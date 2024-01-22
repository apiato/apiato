<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class RevokeRolePermissionsRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    protected array $decode = [
        'role_id',
        'permissions_ids.*',
    ];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [
            'role_id' => 'required|exists:roles,id',
            'permissions_ids' => 'array|required',
            'permissions_ids.*' => 'exists:permissions,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
