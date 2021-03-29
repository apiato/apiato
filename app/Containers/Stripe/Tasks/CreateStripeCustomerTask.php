<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Exceptions\StripeApiErrorException;
use App\Ship\Parents\Tasks\Task;
use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Support\Facades\Config;

class CreateStripeCustomerTask extends Task
{
    private Stripe $stripe;

    public function __construct(Stripe $stripe)
    {
        $this->stripe = $stripe->make(Config::get('settings.stripe.secret'), Config::get('settings.stripe.version'));
    }

    public function run(string $email, string $description = '')
    {
        try {
            $response = $this->stripe->customers()->create([
                'email' => $email,
                'description' => $description,
            ]);

        } catch (Exception $e) {
            throw (new StripeApiErrorException('Stripe API error (createCustomer)'))->debug($e->getMessage(), true);
        }

        return $response;
    }
}
