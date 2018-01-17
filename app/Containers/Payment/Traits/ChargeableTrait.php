<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Gateway\PaymentsGateway;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Models\PaymentTransaction;
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
     * @return  PaymentTransaction
     */
    public function charge(PaymentAccount $account, $amount, $currency = null) : PaymentTransaction
    {
        $transaction = App::make(PaymentsGateway::class)->charge($this, $account, $amount, $currency);

        return $transaction;
    }

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount     $account
     * @param \JohannesSchobel\ShoppingCart\Models\ShoppingCart $cart
     *
     * @return  PaymentTransaction
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart) : PaymentTransaction
    {
        /**
         * get the "value" of the shopping cart
         * Note that MONEY stores the values internally as integers with the smallest currency value (e.g., 500 means 5.00 USD).
         * Basically, we need to re-format it to a respective float value. However, the problem is, that some currencies do not have
         * "smaller" currencies (cents), like others do. JPY (Yen) is such an example.
         * In order to handle this "automatically", we simply use the formatXXX() functions from the shopping cart!
         */
        $amount = $cart->formatMoney($cart->getTotal());
        $amount = floatval($amount);

        $currency = $cart->getTotal()->getCurrency();

        $transaction = $this->charge($account, $amount, $currency);

        $custom = $transaction->custom ? $transaction->custom : [];
        $transaction->custom = array_merge(
            $custom,
            ['cart' => $cart]
        );
        $transaction->save();

        return $transaction;
    }

}
