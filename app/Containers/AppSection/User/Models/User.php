<?php

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\AppSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Parents\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class User extends UserModel
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birth',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'date',
    ];
}
