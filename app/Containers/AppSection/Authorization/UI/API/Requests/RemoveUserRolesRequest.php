<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class RemoveUserRolesRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => null,
    ];

    protected array $decode = [
        'roles_ids.*',
        'user_id',
    ];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [
            'roles_ids' => 'array|required',
            'roles_ids.*' => 'required|exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
