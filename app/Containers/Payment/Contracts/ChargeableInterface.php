<?php

namespace App\Containers\Payment\Contracts;

use App\Containers\Payment\Models\PaymentAccount;
use JohannesSchobel\ShoppingCart\Models\ShoppingCart;

/**
 * Interface ChargeableInterface.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
interface ChargeableInterface
{
    /**
     * Charge the user on a given account
     *
     * @param PaymentAccount                $account
     * @param                               $amount
     * @param                               $currency
     *
     * @return mixed
     */
    public function charge(PaymentAccount $account, $amount, $currency);

    /**
     * Purchase a shopping cart and pay with a given account
     *
     * @param PaymentAccount $account
     * @param ShoppingCart   $cart
     * @param                $currency
     *
     * @return mixed
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart, $currency);

}
