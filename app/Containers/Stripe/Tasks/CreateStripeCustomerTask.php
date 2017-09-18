<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Exceptions\StripeApiErrorException;
use App\Ship\Parents\Tasks\Task;
use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class CreateStripeCustomerTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeCustomerTask extends Task
{

    private $stripe;

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
     * @param string $email
     * @param string $description
     *
     * @return array stripe customer object
     * @throws StripeApiErrorException
     */
    public function run($email, $description = '')
    {
        try {

            $response = $this->stripe->customers()->create([
                'email'       => $email,
                'description' => $description,
            ]);

        } catch (Exception $e) {
            throw (new StripeApiErrorException('Stripe API error (createCustomer)'))->debug($e->getMessage(), true);
        }

        return $response;
    }

}
