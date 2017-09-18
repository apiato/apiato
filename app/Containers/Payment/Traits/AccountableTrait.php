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
}
