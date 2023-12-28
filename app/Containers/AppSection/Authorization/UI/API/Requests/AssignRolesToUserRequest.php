<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class AssignRolesToUserRequest extends ParentRequest
{
    /*
    * Define which Roles and/or Permissions has access to this request.
    */
    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    protected array $decode = [
        'user_id',
        'roles_ids.*',
    ];

    protected array $urlParameters = [
    ];

    public function rules(): array
    {
        return [
            'roles_ids' => 'array|required',
            'roles_ids.*' => 'exists:roles,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
