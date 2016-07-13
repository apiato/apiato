<?php

namespace App\Containers\Paypal\Models;

use App\Containers\User\Models\User;
use App\Port\Model\Abstracts\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaypalAccount.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaypalAccount extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'some_id',
        'user_id',
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

    ];

    /**
     * StripeAccount relationship with User
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
