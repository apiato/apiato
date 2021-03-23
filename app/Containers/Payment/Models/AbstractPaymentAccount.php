<?php

namespace App\Containers\Payment\Models;

use App\Containers\Payment\Contracts\PaymentGatewayAccountInterface;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Class AbstractPaymentAccount
 *
 * This class must be extended by all the payments classes. Such as StripeAccount, PaypalAccount...
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class AbstractPaymentAccount extends Model implements PaymentGatewayAccountInterface
{
    public function checkIfPaymentDataIsSet(array $fields): bool
    {
        foreach ($fields as $field) {
            if ($this->getAttributeValue($field) === null) {
                return false;
            }
        }

        return true;
    }

    public function getDetailAttributes(): array
    {
        $attributes = $this->toArray();

        unset($attributes['id'], $attributes['created_at'], $attributes['updated_at'], $attributes['deleted_at']);

        return $attributes;
    }

    public function paymentAccount(): MorphOne
    {
        return $this->morphOne(PaymentAccount::class, 'accountable');
    }
}
