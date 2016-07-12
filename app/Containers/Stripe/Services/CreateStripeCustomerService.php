<?php

namespace App\Containers\Stripe\Services;

use App\Containers\Stripe\Exceptions\StripeApiErrorException;
use App\Port\Service\Abstracts\Service;
use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class CreateStripeCustomerService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeCustomerService extends Service
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
     * @param        $email
     * @param string $description
     *
     * @return  mixed
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

        if ($response['status'] != 'succeeded') {
            throw new StripeApiErrorException('Stripe response status not succeeded (createCustomer)');
        }

        return $response;
    }

}
