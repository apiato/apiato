<?php

namespace App\Containers\Stripe\Actions;

<<<<<<< HEAD
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\AssignPaymentAccountToUserTask;
use App\Containers\Stripe\Tasks\CreateStripeAccountTask;
=======
>>>>>>> apiato
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

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

<<<<<<< HEAD
        $user = $this->call(FindAuthenticatedUserTask::class);
=======
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
>>>>>>> apiato

        $data = $request->sanitizeInput([
            'customer_id',
            'card_id',
            'card_funding',
            'card_last_digits',
            'card_fingerprint',
            'nickname',
        ]);

        $account = Apiato::call('Stripe@CreateStripeAccountTask', [$data]);

        $result = Apiato::call('Payment@AssignPaymentAccountToUserTask', [$account, $user, $data['nickname']]);

        return $result;
    }

}
