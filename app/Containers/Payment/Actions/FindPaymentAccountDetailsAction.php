<?php

namespace App\Containers\Payment\Actions;

<<<<<<< HEAD:app/Containers/Payment/Actions/FindPaymentAccountDetailsAction.php
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
=======
>>>>>>> apiato:app/Containers/Payment/Actions/GetPaymentAccountDetailsAction.php
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class FindPaymentAccountDetailsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FindPaymentAccountDetailsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD:app/Containers/Payment/Actions/FindPaymentAccountDetailsAction.php
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(FindPaymentAccountByIdTask::class, [$paymentAccountId]);
=======
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = Apiato::call('Payment@GetPaymentAccountByIdTask', [$paymentAccountId]);
>>>>>>> apiato:app/Containers/Payment/Actions/GetPaymentAccountDetailsAction.php

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        return $paymentAccount;
    }
}
