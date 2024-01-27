<?php

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Repositories\Repository as ParentRepository;

class TestUserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => 'ilike',
    ];

    public function model(): string
    {
        return TestUser::class;
    }
}
