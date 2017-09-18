<?php

namespace App\Containers\Payment\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function accountable() {
        return $this->morphTo();
    }
}
