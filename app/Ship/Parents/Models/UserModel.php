<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use App\Ship\Contracts\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\LaravelData\WithData;
use Spatie\Permission\Traits\HasRoles;

/**
 * @template T
 */
abstract class UserModel extends AbstractUserModel implements Authorizable
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    /** @use WithData<T> */
    use WithData;
}
