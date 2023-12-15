<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class DetachPermissionsFromUserRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => '',
    ];

    protected array $decode = [
        'id',
        'permissions_ids.*',
    ];

    protected array $urlParameters = [
        'id',
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'permissions_ids' => 'array|required',
            'permissions_ids.*' => 'exists:permissions,id',
            'id' => 'required|exists:users,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}
