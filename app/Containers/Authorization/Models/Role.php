<?php

namespace App\Containers\Authorization\Models;

use Spatie\Permission\Models\Role as LaratrustRole;

/**
 * Class Role
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Role extends LaratrustRole
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];
}
