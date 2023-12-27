<?php

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

class UserRepository extends ParentRepository
{
    protected $fieldSearchable = [
        'name' => 'like',
        'id' => '=',
        'email' => '=',
        'email_verified_at' => '=',
        'created_at' => 'like',
    ];

    public function model(): string
    {
        return User::class;
    }
}
