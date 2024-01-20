<?php

namespace App\Containers\AppSection\Authorization\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class UnauthorizedRequest extends ParentRequest
{
    protected array $access = [
        'permissions' => [],
        'roles' => [],
    ];

    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return $this->hasAccess();
    }
}
