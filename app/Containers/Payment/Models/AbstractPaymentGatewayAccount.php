<?php

namespace App\Containers\Payment\Models;

use App\Containers\Payment\Contracts\PaymentGatewayAccountInterface;
use App\Containers\Payment\Traits\AccountableTrait;
use App\Ship\Parents\Models\Model;

abstract class AbstractPaymentGatewayAccount extends Model implements PaymentGatewayAccountInterface
{
    use AccountableTrait;

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
