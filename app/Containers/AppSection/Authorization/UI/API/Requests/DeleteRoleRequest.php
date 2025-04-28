<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class DeleteRoleRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => 'manage-roles',
        'roles'       => null,
    ];

    protected array $decode = [
        'role_id',
    ];

    protected array $urlParameters = [
        'role_id',
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
