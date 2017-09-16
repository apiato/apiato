<?php

namespace App\Containers\Payment\Traits;

use App\Containers\Payment\Models\PaymentAccount;

/**
 * Trait AccountableTrait
 *
 * @author Johannes Schobel <johannes.schobel@googlemail.com>
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

    public function getDetailAttributes() {
        $attributes = $this->toArray();

        unset($attributes['id']);
        unset($attributes['created_at']);
        unset($attributes['updated_at']);
        unset($attributes['deleted_at']);

        return $attributes;
    }
}
