<?php

namespace App\Containers\Payment\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentAccount
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PaymentAccount extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'accountable_id',
        'accountable_type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];


    /**
     * @return  \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function accountable()
    {
        return $this->morphTo();
    }
}
