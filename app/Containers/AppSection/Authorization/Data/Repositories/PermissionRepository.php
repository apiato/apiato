<?php

namespace App\Containers\AppSection\Authorization\Data\Repositories;

use App\Containers\AppSection\Authorization\Data\Repositories\Concerns\InteractsWithGuard;
use App\Containers\AppSection\Authorization\Models\Permission;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

/**
 * @template TModel of Permission
 *
 * @extends ParentRepository<TModel>
 */
final class PermissionRepository extends ParentRepository
{
    use InteractsWithGuard;

    protected $fieldSearchable = [
        'name' => '=',
        'display_name' => 'like',
        'description' => 'like',
    ];

    public function model(): string
    {
        return config('permission.models.permission');
    }
}
