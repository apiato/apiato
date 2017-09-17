<?php

namespace App\Containers\Payment\Contracts;

use App\Containers\Payment\Models\AbstractPaymentGatewayAccount;

/**
 * Interface PaymentChargerTaskInterface
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
interface PaymentChargerTaskInterface
{
    /**
     * Performs the transaction by making a request to the service provider (e.g., paypal, stripe, ...)
     *
     * @param ChargeableInterface           $user    the user which is charged
     * @param AbstractPaymentGatewayAccount $account the account to be used to charge the user with
     * @param float                         $amount  the amount to be charged
     * @param string                        $currency
     *
     * @return mixed
     */
    public function run(ChargeableInterface $user, AbstractPaymentGatewayAccount $account, $amount, $currency);

}
