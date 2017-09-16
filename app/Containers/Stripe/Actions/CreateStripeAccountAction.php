<?php

namespace App\Containers\Stripe\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Containers\Stripe\Models\StripeAccount;
use App\Containers\Stripe\Tasks\CreateStripeAccountTask;
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

        $user = $this->call(GetAuthenticatedUserTask::class);

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
