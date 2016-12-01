<?php

namespace App\Containers\Stripe\UI\API\Controllers;

use App\Containers\Stripe\Actions\CreateStripeAccountAction;
use App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Stripe\UI\API\Requests\CreateStripeAccountRequest $request
     * @param \App\Containers\Stripe\Actions\CreateStripeAccountAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createStripeAccount(CreateStripeAccountRequest $request, CreateStripeAccountAction $action)
    {
        $stripeAccount = $action->run(
            $request->user(),
            $request->customer_id,
            $request->card_id,
            $request->card_funding,
            $request->card_last_digits,
            $request->card_fingerprint
        );

        return $this->response->accepted(null, [
            'message'           => 'Stripe account created successfully.',
            'stripe_account_id' => $stripeAccount->id,
        ]);
    }

}
