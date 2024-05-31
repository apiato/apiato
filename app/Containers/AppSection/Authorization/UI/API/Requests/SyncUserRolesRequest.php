<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class SyncUserRolesRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => null,
    ];

    protected array $decode = [
        'user_id',
        'role_ids.*',
    ];

    protected array $urlParameters = [
        'user_id',
    ];

    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'role_ids' => 'array|required',
            'role_ids.*' => 'required|exists:roles,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
