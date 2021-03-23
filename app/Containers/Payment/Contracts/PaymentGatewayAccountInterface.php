<?php

namespace App\Containers\Payment\Contracts;

interface PaymentGatewayAccountInterface
{
    /**
     * Returns the relative URL segment (xyz) for a payment account (e.g., /users/paymentaccounts/xyz). This is also the
     * key for the config file
     */
    public function getPaymentGatewaySlug(): string;

    /**
     * Returns a "human readable" name for this type of account
     */
    public function getPaymentGatewayReadableName(): string;

    /**
     * Checks, if required fields are set (i.e., they are NOT NULL)
     * @param array $fields
     * @return bool
     */
    public function checkIfPaymentDataIsSet(array $fields): bool;

    /**
     * Returns a key => value list of attributes to be displayed in the DetailTransformer. This automatically excludes
     * "hidden" elements, id, created/updated/deleted timestamps
     */
    public function getDetailAttributes(): array;
}
