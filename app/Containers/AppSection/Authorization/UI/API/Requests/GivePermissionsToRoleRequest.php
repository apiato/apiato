<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class GivePermissionsToRoleRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => null,
    ];

    protected array $decode = [
        'permission_ids.*',
        'role_id',
    ];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [
            'permission_ids' => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
