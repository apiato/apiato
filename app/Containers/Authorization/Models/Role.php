<?php

namespace App\Containers\Authorization\Models;

use App\Ship\Engine\Traits\HashIdTrait;
use App\Ship\Engine\Traits\HasResourceKeyTrait;
use Spatie\Permission\Models\Role as LaratrustRole;

/**
 * Class Role
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Role extends LaratrustRole
{

    use HashIdTrait;
    use HasResourceKeyTrait;

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
