<?php

namespace App\Ship\Parents\Models;

use App\Containers\Authentication\Traits\TokenTrait;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Ship\Engine\Traits\HashIdTrait;
use App\Ship\Features\Payment\Contracts\ChargeableInterface;
use App\Ship\Features\Payment\Traits\ChargeableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as LaravelAuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends LaravelAuthenticatableUser implements ChargeableInterface
{
    use Notifiable, HashIdTrait, HasApiTokens, SoftDeletes, TokenTrait, HasRoles, AuthorizationTrait, ChargeableTrait;
}
