<?php

namespace App\Containers\AppSection\User\Casts;

use App\Containers\AppSection\User\Values\Email;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class EmailCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): Email
    {
        return new Email($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
//        if (! $value instanceof self) {
//            throw new \InvalidArgumentException('The given value is not an Email instance.');
//        }

        return $value->email;
    }
}
