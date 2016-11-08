<?php

namespace App\Containers\Authorization\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * Class Permission
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Permission extends EntrustPermission
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
