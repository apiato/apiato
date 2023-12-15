<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\Authorization\Traits\IsResourceOwnerTrait;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class UpdateUserPasswordRequest extends ParentRequest
{
    use IsResourceOwnerTrait;

    protected array $access = [
        'permissions' => '',
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
            'current_password' => [Rule::requiredIf(
                fn (): bool => !is_null($this->user()->password)
            ), 'current_password:api'],
            'new_password' => [
                'required',
                User::getPasswordValidationRules(),
            ],
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess|isResourceOwner',
        ]);
    }
}
