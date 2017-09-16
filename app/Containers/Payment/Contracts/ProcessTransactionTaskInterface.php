<?php

namespace App\Containers\Payment\Contracts;

/**
 * Interface ProcessTransactionTaskInterface
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
interface ProcessTransactionTaskInterface
{
    /**
     * Performs the transaction by making a request to the service provider (e.g., paypal, stripe, ...)
     *
     * @param ChargeableInterface                  $user   the user which is charged
     * @param PaymentGatewayAccount                $account the account to be used to charge the user with
     * @param float                                $amount the amount to be charged
     * @param string                               $currency
     *
     * @return mixed
     */
    public function run(ChargeableInterface $user, PaymentGatewayAccount $account, $amount, $currency);

}
