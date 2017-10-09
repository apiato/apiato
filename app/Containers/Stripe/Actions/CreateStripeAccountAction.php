<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Stripe\Tasks\CreateStripeAccountTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

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

        $user = $this->call(FindAuthenticatedUserTask::class);

        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
        ]);

        $info = $request->sanitizeInput([
            'name',
        ]);

        $account = $this->call(CreateStripeAccountTask::class, [$data]);

        $result = $this->call(AssignPaymentAccountToUserTask::class, [$account, $user, $info]);

        return $result;
    }

}
