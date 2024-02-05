<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ParentRequest
{
    protected array $decode = [
        'id',
    ];

    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'name' => 'min:2|max:50',
            'gender' => Rule::enum(Gender::class),
            'birth' => 'date',
        ];
    }

    public function authorize(Gate $gate): bool
    {
        return $gate->allows('update', [User::class, $this->id]);
    }
}
