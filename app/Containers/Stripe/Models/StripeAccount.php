<?php

namespace App\Containers\Stripe\Models;

use App\Containers\Payment\Models\AbstractPaymentAccount;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StripeAccount.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
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
        'deleted_at',
    ];

    /**
     * @return string
     */
    public function getPaymentGatewayReadableName()
    {
        return 'Stripe';
    }

    /**
     * @return string
     */
    public function getPaymentGatewaySlug()
    {
        return 'stripe';
    }
}
