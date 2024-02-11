<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;

class ListUsersRequest extends AbstractUserRequest
{
    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [];
    }

    public function authorize(Gate $gate): bool
    {
        return $gate->allows('index', [User::class]);
    }
}
