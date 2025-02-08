<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class ListRolesRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [];
    }

    public function authorize(): bool
    {
        return false;
    }
}
