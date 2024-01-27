<?php

namespace App\Ship\Tests\Fakes;

use App\Ship\Parents\Models\UserModel as ParentUserModel;

class TestUser extends ParentUserModel
{
    protected $table = 'test_users';

    protected $fillable = [
        'name',
        'published',
    ];

    protected string $resourceKey = 'TestUser';

    public function hasAdminRole(): bool
    {
        return false;
    }
}
