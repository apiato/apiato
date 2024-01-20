<?php

namespace App\Containers\AppSection\Authorization\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class UnauthorizedRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => [],
        'roles' => [],
    ];

    protected array $decode = [
    ];

    protected array $urlParameters = [
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
