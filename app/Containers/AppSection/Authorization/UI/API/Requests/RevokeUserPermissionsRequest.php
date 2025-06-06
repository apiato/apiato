<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Requests\Request as ParentRequest;

final class RevokeUserPermissionsRequest extends ParentRequest
{
    protected array $decode = [
        'user_id',
        'permission_ids.*',
    ];

    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'permission_ids' => 'array|required',
            'permission_ids.*' => 'exists:permissions,id',
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('revoke', Permission::class);
    }
}
