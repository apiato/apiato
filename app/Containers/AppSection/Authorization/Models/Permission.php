<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Foundation\Support\Traits\Model\ModelTrait;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission implements ResourceKeyAware
{
    use ModelTrait;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): PermissionCollection
    {
        return new PermissionCollection($models);
    }
}
