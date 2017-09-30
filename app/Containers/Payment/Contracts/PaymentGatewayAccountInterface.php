<?php

namespace App\Containers\Payment\Contracts;

/**
 * Interface PaymentGatewayAccount
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
interface PaymentGatewayAccountInterface
{
    /**
     * Returns the relative URL segment (xyz) for a payment account (e.g., /users/paymentaccounts/xyz). This is also the
     * key for the config file
     *
     * @return string
     */
    public function getPaymentGatewaySlug();

    /**
     * Returns a "human readable" name for this type of account
     *
     * @return string
     */
    public function getPaymentGatewayReadableName();

    /**
     * Checks, if required fields are set (i.e., they are NOT NULL)
     *
     * @param array $fields
     *
     * @return bool
     */
    public function checkIfPaymentDataIsSet(array $fields);

    /**
     * Returns a key => value list of attributes to be displayed in the DetailTransformer. This automatically excludes
     * "hidden" elements, id, created/updated/deleted timestamps
     *
     * @return array
     */
    public function getDetailAttributes();
}