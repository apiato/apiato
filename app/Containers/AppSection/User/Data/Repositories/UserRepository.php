<?php

namespace App\Containers\AppSection\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class UserRepository extends Repository
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
        return config('auth.providers.users.model');
    }
}
