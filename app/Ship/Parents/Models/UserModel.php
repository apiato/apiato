<?php

namespace App\Ship\Parents\Models;

use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Ship\Engine\Traits\HashIdTrait;
use App\Ship\Engine\Traits\TokenTrait;
use App\Ship\Payment\Contracts\ChargeableInterface;
use App\Ship\Payment\Traits\ChargeableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as LaravelAuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends LaravelAuthenticatableUser implements ChargeableInterface
{

    use Notifiable, HashIdTrait, SoftDeletes, HasRoles, AuthorizationTrait, ChargeableTrait, HasApiTokens, TokenTrait;

}
