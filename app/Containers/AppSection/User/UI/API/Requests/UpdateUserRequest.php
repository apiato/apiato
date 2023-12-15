<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\Authorization\Traits\IsResourceOwnerTrait;
use App\Ship\Parents\Requests\Request as ParentRequest;

class UpdateUserRequest extends ParentRequest
{
    use IsResourceOwnerTrait;

    protected array $access = [
        'permissions' => 'update-users',
        'roles' => '',
    ];

    protected array $decode = [
        'id',
    ];

    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'name' => 'min:2|max:50',
            'gender' => 'in:male,female,unspecified',
            'birth' => 'date',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess|isResourceOwner',
        ]);
    }
}
