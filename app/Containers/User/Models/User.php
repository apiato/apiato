<?php

namespace App\Containers\User\Models;

use App\Containers\ApiAuthentication\Services\TokenTrait;
use App\Containers\Paypal\Models\PaypalAccount;
use App\Containers\Stripe\Models\StripeAccount;
use App\Port\Model\Abstracts\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends Model implements
    AuthenticatableContract,
    CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, TokenTrait, EntrustUserTrait;

    // use SoftDeletes;

    /**
     * TODO:
     * Temporary hiding the Illuminate\Database\Eloquent\SoftDeletes trait because
     * of the collisions of the restore function with the EntrustUserTrait.
     * Will be uncommented once a fix PR is merged in the repo (https://github.com/Zizaco/entrust/issues/428)
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmed',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stripeAccount()
    {
        return $this->hasOne(StripeAccount::class);
    }

    /**
     * @return  \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function paypalAccount()
    {
        return $this->hasOne(PaypalAccount::class);
    }

}
