<?php

namespace App\Containers\Payment\Factories;

use App\Containers\Payment\Contracts\Chargeable;
use App\Containers\Payment\Exceptions\ObjectNonChargeableException;
use App\Containers\Payment\Exceptions\PaymentMethodNotFoundException;
use App\Containers\Payment\Exceptions\UserNotSetInThePaymentTaskException;
use App\Containers\Paypal\Tasks\ChargeWithPaypalTask;
use App\Containers\Stripe\Tasks\ChargeWithStripeTask;
use App\Containers\User\Models\User;
use Illuminate\Support\Facades\App;

/**
 * Class PaymentsFactory
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PaymentsFactory
{

    protected $method = null;

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  mixed
     */
    public function charge(User $user, $amount, $currency = 'USD')
    {
        $this->setUserPaymentMethod($user);

        return $this->method->charge($user, $amount, $currency);
    }

    /**
     * @param \App\Containers\User\Models\User $user
     */
    public function setUserPaymentMethod(User $user)
    {
        if ($user->stripeAccount !== null) {
            $this->method = App::make(ChargeWithStripeTask::class);
        } elseif ($user->paypalAccount !== null) {
            $this->method = App::make(ChargeWithPaypalTask::class);
        }
//        elseif ($user->...Account !== null) {
//            $this->method = App::make(ChargeWith...Task::class);
//        }

        // validate a payment method was found
        if ($this->method == null) {
            throw new PaymentMethodNotFoundException();
        }

        // validate containing charge function
        if (!$this->method instanceof Chargeable) {
            throw (new ObjectNonChargeableException())
                ->debug('The payment services must implement the Chargeable interface');
        }
    }

    /**
     * @return  null
     */
    public function getPaymentMethod()
    {
        return $this->method;
    }

}
