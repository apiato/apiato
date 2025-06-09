<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Tests\Unit\Data\Repositories\Concerns;

use App\Containers\AppSection\Authorization\Data\Repositories\Concerns\InteractsWithGuard;
use App\Ship\Tests\Fakes\TestUser;
use App\Ship\Tests\Fakes\TestUserRepository;

final class TraitTestRepository extends TestUserRepository
{
    use InteractsWithGuard;

    #[\Override]
    public function model(): string
    {
        return TestUser::class;
    }
}
