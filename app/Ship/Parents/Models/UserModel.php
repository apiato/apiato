<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

abstract class UserModel extends AbstractUserModel
{
    use Notifiable;
    use HasApiTokens;
}
