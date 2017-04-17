<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\App;

/**
 * Class CreateStripeAccountAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateStripeAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $stripeAccount = new StripeAccount();
        $stripeAccount->customer_id = $request->customer_id;
        $stripeAccount->card_id = $request->card_id;
        $stripeAccount->card_funding = $request->card_funding;
        $stripeAccount->card_last_digits = $request->card_last_digits;
        $stripeAccount->card_fingerprint = $request->card_fingerprint;
        $stripeAccount->user()->associate($request->user());

        return $stripeAccount = App::make(StripeAccountRepository::class)->create($stripeAccount->toArray());
    }

}
