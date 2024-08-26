<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;

class FindUserByIdRequest extends AbstractUserRequest
{
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

    public function authorize(Gate $gate): bool
    {
        return $gate->allows('show', [User::class]);
    }
}
