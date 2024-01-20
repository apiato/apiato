<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class SyncPermissionsOnRoleRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    protected array $decode = [
        'permissions_ids.*',
        'role_id',
    ];

    protected array $urlParameters = [
    ];

    public function rules(): array
    {
        return [
            'permissions_ids' => 'array|required',
            'permissions_ids.*' => 'required|exists:permissions,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
