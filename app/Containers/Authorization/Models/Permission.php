<?php

namespace App\Containers\Authorization\Models;

use App\Port\HashId\Traits\HashIdTrait;
use Spatie\Permission\Models\Permission as LaratrustPermission;

/**
 * Class Permission
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Permission extends LaratrustPermission
{

    use HashIdTrait;

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
