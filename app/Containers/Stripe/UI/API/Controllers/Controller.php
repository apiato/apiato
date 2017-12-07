<?php

namespace App\Containers\Stripe\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest;
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
        $sanitizedData = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
            'nickname',
        ]);

        $stripeAccount = Apiato::call('Stripe@CreateStripeAccountAction', [$sanitizedData]);

        return $this->accepted([
            'message'           => 'Stripe account created successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

    /**
     * @param \App\Containers\Stripe\UI\API\Requests\UpdateStripeAccountRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function updateStripeAccount(UpdateStripeAccountRequest $request)
    {
        $sanitizedData = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $stripeAccount = Apiato::call('Stripe@UpdateStripeAccountAction', [$request->getInputByKey('id'), $sanitizedData]);

        return $this->accepted([
            'message'           => 'Stripe account updated successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

}
