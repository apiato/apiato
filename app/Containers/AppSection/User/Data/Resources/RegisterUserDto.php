<?php

namespace App\Containers\AppSection\User\Data\Resources;

use App\Containers\AppSection\User\Enums\Gender;
use App\Containers\AppSection\User\Values\Email;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithCastable;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use Spatie\LaravelData\Dto;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Resource;

class RegisterUserDto extends Resource
{
    public function __construct(
        public string|Optional $name,
        public string|Optional|null $verification_url,
        #[WithCast(Email::class)]
        public Email $email,
        public string $password,
    ) {
    }
}
