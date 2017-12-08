<?php

namespace App\Containers\Payment\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class DeletePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeletePaymentAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  void
     */
    public function run(Request $request): void
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$request->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        Apiato::call('Payment@DeletePaymentAccountTask', [$paymentAccount]);
    }
}
