<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Proxies\PaymentsProxy;
use Illuminate\Support\Facades\App;
use JohannesSchobel\ShoppingCart\Models\ShoppingCart;

/**
 * Class ChargeableTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait ChargeableTrait
{
    /**
     * @param PaymentAccount $account
     * @param float          $amount
     * @param string         $currency
     *
     * @return
     */
    public function charge(PaymentAccount $account, $amount, $currency)
    {
        return App::make(PaymentsProxy::class)->charge($this, $account, $amount, $currency);
    }

    /**
     * @param PaymentAccount $account
     * @param ShoppingCart   $cart
     * @param string         $currency
     *
     * @return mixed
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart, $currency)
    {
        $amount = $cart->getTotal();
        return App::make(PaymentsProxy::class)->charge($this, $account, $amount, $currency);
    }

}
