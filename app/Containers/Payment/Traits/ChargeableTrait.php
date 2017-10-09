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
     * @param                                               $amount
     * @param null                                          $currencyCode
     *
     * @return  mixed
     */
    public function charge(PaymentAccount $account, $amount, $currencyCode = null)
    {
        return App::make(PaymentsGateway::class)->charge($this, $account, $amount, $currencyCode);
    }

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount     $account
     * @param \JohannesSchobel\ShoppingCart\Models\ShoppingCart $cart
     * @param null                                              $currency
     *
     * @return  mixed
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart, $currency = null)
    {
        $amount = $cart->getTotal();

        return App::make(PaymentsGateway::class)->charge($this, $account, $amount, $currency);
    }

}
