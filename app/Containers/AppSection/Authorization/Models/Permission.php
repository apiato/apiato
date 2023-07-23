<?php

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Traits\ModelTrait;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use ModelTrait;

    protected string $guard_name = 'api';

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];
}
