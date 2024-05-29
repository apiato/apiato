<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class ListUserPermissionsRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-permissions',
        'roles' => null,
    ];

    protected array $decode = [
        'user_id',
    ];

    protected array $urlParameters = [
        'user_id',
    ];

    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
