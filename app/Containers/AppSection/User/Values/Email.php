<?php

namespace App\Containers\AppSection\User\Values;

use Apiato\Core\Abstracts\Values\Value;
use App\Ship\Parents\Values\Value as ParentValue;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class Email extends ParentValue implements  ValidatesWhenResolved, Cast, Castable
{
    public function __construct(public readonly string $email)
    {
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:users,email',
                ],
            ];
    }

    public function validateResolved(): void
    {
        tap(validator(['email' => $this->email], $this->rules()))->validate();
    }

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): Email
    {
        return app(Email::class, [$property->name => $value]);
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes {
            public function get(Model $model, string $key, mixed $value, array $attributes): Email
            {
                return app(Email::class, [$key => $value]);
            }

            public function set(Model $model, string $key, mixed $value, array $attributes): string
            {
                if (is_a($value, Email::class)) {
                    return $value->email;
                }

                return $value;
            }
        };
    }
}
