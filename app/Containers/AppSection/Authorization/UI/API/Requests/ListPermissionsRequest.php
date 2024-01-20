<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class ListPermissionsRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-roles',
        'roles' => '',
    ];

    protected array $decode = [
    ];

    protected array $urlParameters = [
    ];

    public function rules(): array
    {
        return [
        ];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
