<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Gateway\PaymentsGateway;
use App\Containers\Payment\Models\PaymentAccount;
use Illuminate\Support\Facades\App;
use JohannesSchobel\ShoppingCart\Models\ShoppingCart;

/**
 * Class ChargeableTrait.
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ChargeableTrait
{

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount $account
     * @param int|float                                     $amount
     * @param string|null                                   $currency
     *
     * @return  mixed
     */
    public function charge(PaymentAccount $account, $amount, $currency = null)
    {
        return App::make(PaymentsGateway::class)->charge($this, $account, $amount, $currency);
    }

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount     $account
     * @param \JohannesSchobel\ShoppingCart\Models\ShoppingCart $cart
     *
     * @return  mixed
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart)
    {
        // get the "value" of the shopping cart
        // note that MONEY stores the values internally as integers converted to strings. So we must divide by 100 to
        // get the float value. This is, because working (e.g., calculating) with FLOATs is quite ugly :(
        $amount = (int)$cart->getTotal()->getAmount();
        $amount = floatval($amount/100);

        $currency = $cart->getTotal()->getCurrency();

        return App::make(PaymentsGateway::class)->charge($this, $account, $amount, $currency);
    }

}
