<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Exceptions\StripeAccountNotFoundException;
use App\Containers\Stripe\Exceptions\StripeApiErrorException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class ChargeWithStripeTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ChargeWithStripeTask extends Task
{

    public $stripe;

    /**
     * StripeApi constructor.
     *
     * @param \Cartalyst\Stripe\Stripe $stripe
     */
    public function __construct(Stripe $stripe)
    {
        $this->stripe = $stripe->make(Config::get('services.stripe.secret'), Config::get('services.stripe.version'));
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  array|null
     */
    public function run(User $user, $amount, $currency = 'USD')
    {
        $stripeAccount = $user->stripeAccount;

        if(!$stripeAccount){
            throw new StripeAccountNotFoundException('We could not find your credit card information. 
            For security reasons, we do not store your credit card information on our server. 
            So please login to our Web App and enter your credit card information directly into Stripe, 
            then try to purchase the credits again. 
            Thanks.');
        }

        try {

            $response = $this->stripe->charges()->create([
                'customer' => $user->stripeAccount->customer_id,
                'currency' => $currency,
                'amount'   => $amount,
            ]);

        } catch (Exception $e) {
            throw (new StripeApiErrorException('Stripe API error (chargeCustomer)'))->debug($e->getMessage(), true);
        }

        if ($response['status'] != 'succeeded') {
            throw new StripeApiErrorException('Stripe response status not succeeded (chargeCustomer)');
        }

        if ($response['paid'] !== true) {
            return null;
        }

        // this data will be stored on the pivot table (user credits)
        return [
            'payment_method' => 'stripe',
            'description'    => $response['id'] // the charge id
        ];
    }

}
