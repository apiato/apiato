<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

abstract class UserModel extends AbstractUserModel
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasApiTokens;
}
