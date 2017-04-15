<?php

namespace App\Ship\Payment\Proxies;

use App\Containers\Stripe\Tasks\ChargeWithStripeTask;
use App\Ship\Payment\Contracts\ChargeableInterface;
use Illuminate\Support\Facades\App;

/**
 * Class PaymentsProxy.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PaymentsProxy
{

    /**
     * @param \App\Ship\Payment\Contracts\ChargeableInterface $object
     * @param                                                          $amount
     * @param                                                          $currency
     * @param null                                                     $paymentMethod
     *
     * @return  mixed
     */
    public function charge(ChargeableInterface $object, $amount, $currency, $paymentMethod = null)
    {
        if (!$paymentMethod) {
            $paymentMethod = $this->chargeWithStripe($object);
        }

        if (!$paymentMethod) {
            $paymentMethod = $this->chargeWithPaypal($object);
        }

        // run the right task for the available method
        return $paymentMethod->run($object, $amount, $currency);
    }

    /**
     * @param $object
     *
     * @return  null
     */
    private function chargeWithStripe($object)
    {
        return $object->stripeAccount ? App::make(ChargeWithStripeTask::class) : null;
    }

    /**
     * @param $object
     *
     * @return  null
     */
    private function chargeWithPaypal($object)
    {
        return null; // TODO: to be implemented once a Paypal container is ready
    }

}
