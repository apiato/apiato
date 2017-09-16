<?php

namespace App\Containers\Payment\Models;

use App\Ship\Parents\Models\Model;

class PaymentAccount extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'accountable_id',
        'accountable_type',
    ];

    protected $hidden = [];

    protected $casts = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function accountable() {
        return $this->morphTo();
    }
}
