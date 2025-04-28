<?php

declare(strict_types=1);

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class TestUserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => 'ilike',
    ];

    #[\Override]
    public function model(): string
    {
        return TestUser::class;
    }
}
