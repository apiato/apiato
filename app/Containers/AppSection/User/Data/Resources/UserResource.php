<?php

namespace App\Containers\AppSection\User\Data\Resources;

use App\Containers\AppSection\User\Enums\Gender;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Resource;

class UserResource extends Resource
{
    public function __construct(
        #[MapInputName('user_id')]
        public string|Optional|null $id,
        public string|Optional $name,
        public string|Optional $email,
        public CarbonImmutable|Optional $email_verified_at,
        public string|Optional $password,
        public Gender|Optional $gender,
        public CarbonImmutable|Optional $birth,
    ) {
    }
}
