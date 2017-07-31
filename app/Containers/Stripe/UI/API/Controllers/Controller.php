<?php

namespace App\Containers\Stripe\UI\API\Controllers;

use App\Containers\Stripe\Actions\CreateStripeAccountAction;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function createStripeAccount(CreateStripeAccountRequest $request)
    {
        $stripeAccount = $this->call(CreateStripeAccountAction::class, [$request]);

        return $this->accepted([
            'message'           => 'Stripe account created successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

}
