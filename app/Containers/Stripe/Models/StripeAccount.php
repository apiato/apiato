<?php

namespace App\Containers\Stripe\Models;

use App\Containers\Payment\Models\AbstractPaymentAccount;
use Illuminate\Database\Eloquent\SoftDeletes;

class StripeAccount extends AbstractPaymentAccount
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'card_id',
        'card_funding',
        'card_last_digits',
        'card_fingerprint',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getPaymentGatewayReadableName(): string
    {
        return 'Stripe';
    }

    public function getPaymentGatewaySlug(): string
    {
        return 'stripe';
    }
}
