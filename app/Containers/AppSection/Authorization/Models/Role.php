<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Contracts\HasResourceKey;
use Apiato\Core\Traits\ModelTrait;
use App\Containers\AppSection\Authorization\Data\Collections\RoleCollection;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole implements HasResourceKey
{
    use ModelTrait;

    protected string $guard_name = 'api';

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): RoleCollection
    {
        return new RoleCollection($models);
    }
}
