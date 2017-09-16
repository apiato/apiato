<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Models\PaymentAccount;

/**
 * Trait AccountableTrait
 *
 * @package App\Containers\Payment\Traits
 */
trait AccountableTrait
{
    public function paymentAccount() {
        return $this->morphOne(PaymentAccount::class, 'accountable');
    }

    public function checkIfPaymentDataIsSet(array $fields) {

        foreach ($fields as $field) {
            if ($this->getAttributeValue($field) === null) {
                return false;
            }
        }

        return true;
    }
}
