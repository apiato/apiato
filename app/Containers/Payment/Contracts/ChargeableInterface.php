<?php

namespace App\Containers\Payment\Contracts;

use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Models\PaymentTransaction;
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
     * @param int|float                     $amount
     * @param string|null                   $currency
     *
     * @return PaymentTransaction
     */
    public function charge(PaymentAccount $account, $amount, $currency) : PaymentTransaction;

    /**
     * Purchase a shopping cart and pay with a given account
     *
     * @param PaymentAccount $account
     * @param ShoppingCart   $cart
     *
     * @return PaymentTransaction
     */
    public function purchaseShoppingCart(PaymentAccount $account, ShoppingCart $cart) : PaymentTransaction;

}
