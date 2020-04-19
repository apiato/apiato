<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends AbstractUserModel
{

    use Notifiable;
    use SoftDeletes;
    use HashIdTrait;
    use HasRoles;
    use HasApiTokens;
    use HasResourceKeyTrait;

}
