<?php

namespace App\Containers\Payment\Contracts;

use App\Containers\Payment\Models\AbstractPaymentAccount;
use App\Containers\Payment\Models\PaymentTransaction;

/**
 * Interface  PaymentChargerInterface
 *
 * @author   Johannes Schobel <johannes.schobel@googlemail.com>
 */
interface PaymentChargerInterface
{

    /**
     * Performs the transaction by making a request to the service provider (e.g., paypal, stripe, ...)
     *
     * @param ChargeableInterface    $user    the user which is charged
     * @param AbstractPaymentAccount $account the account to be used to charge the user with
     * @param float                  $amount  the amount to be charged
     * @param string                 $currency
     *
     * @return PaymentTransaction
     */
    public function charge(ChargeableInterface $user, AbstractPaymentAccount $account, $amount, $currency) : PaymentTransaction;

}
