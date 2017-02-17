<?php

namespace App\Ship\Model\Abstracts;

use App\Containers\Authentication\Traits\TokenTrait;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Ship\HashId\Traits\HashIdTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as LaravelAuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends LaravelAuthenticatableUser
{

    use Notifiable, HashIdTrait, SoftDeletes, TokenTrait, HasRoles, AuthorizationTrait;

}
