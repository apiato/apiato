<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Contracts\Auth\Access\Gate;

class FindUserByIdRequest extends ParentRequest
{
    protected array $decode = [
        'id',
    ];

    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [];
    }

    public function authorize(Gate $gate): bool
    {
        return $gate->allows('show', [User::class]);
    }
}
