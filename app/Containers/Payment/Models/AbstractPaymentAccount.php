<?php

namespace App\Containers\Payment\Models;

use App\Containers\Payment\Contracts\PaymentGatewayAccountInterface;
use App\Ship\Parents\Models\Model;

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

    /**
     * @param array $fields
     *
     * @return  bool
     */
    public function checkIfPaymentDataIsSet(array $fields)
    {
        foreach ($fields as $field) {
            if ($this->getAttributeValue($field) === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return  array
     */
    public function getDetailAttributes()
    {
        $attributes = $this->toArray();

        unset($attributes['id']);
        unset($attributes['created_at']);
        unset($attributes['updated_at']);
        unset($attributes['deleted_at']);

        return $attributes;
    }

    public function paymentAccount()
    {
        return $this->morphOne(PaymentAccount::class, 'accountable');
    }
}
