<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Contracts\Auth\Access\Gate;

class DeleteUserRequest extends ParentRequest
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
        return $gate->allows('delete', [User::class]);
    }
}
