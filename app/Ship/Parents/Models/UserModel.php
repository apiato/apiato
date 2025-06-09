<?php

declare(strict_types=1);

namespace App\Ship\Parents\Models;

use Apiato\Core\Models\UserModel as AbstractUserModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

abstract class UserModel extends AbstractUserModel implements MustVerifyEmail
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;
}
