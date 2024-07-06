<?php

namespace App\Containers\AppSection\User\UI\API\Requests;

use App\Containers\AppSection\User\Data\Resources\RegisterUserDto;
use App\Containers\AppSection\User\Data\Resources\UserResource;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * @template T of UserResource
 *
 * @extends ParentRequest<T>
 */
abstract class AbstractUserRequest extends ParentRequest
{
    abstract public function rules(): array;

    abstract public function authorize(Gate $gate): bool;

    /**
     * @return class-string<T>
     */
    final public function dataClass(): string
    {
        return RegisterUserDto::class;
    }
}
