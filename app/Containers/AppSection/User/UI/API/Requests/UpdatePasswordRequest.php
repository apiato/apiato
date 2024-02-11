<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends AbstractUserRequest
{
    protected array $decode = [
        'user_id',
    ];

    protected array $urlParameters = [
        'user_id',
    ];

    public function rules(): array
    {
        return [
            'current_password' => [Rule::requiredIf(
                fn (): bool => null !== $this->user()->password,
            ), 'current_password:api'],
            'new_password' => [
                'required',
                Password::default(),
            ],
        ];
    }

    public function authorize(Gate $gate): bool
    {
        return $gate->allows('update', [User::class, $this->user_id]);
    }
}
