<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\Authorization\Traits\IsResourceOwnerTrait;
use App\Ship\Parents\Requests\Request as ParentRequest;

class UpdateUserRequest extends ParentRequest
{
    use IsResourceOwnerTrait;

    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'update-users',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'id',
    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
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
