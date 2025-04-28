<?php

declare(strict_types=1);

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use App\Ship\Contracts\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

abstract class UserModel extends AbstractUserModel implements Authorizable
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;
}
