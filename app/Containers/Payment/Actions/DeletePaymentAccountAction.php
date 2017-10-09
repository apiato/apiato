<?php

namespace App\Containers\Payment\Actions;

<<<<<<< HEAD
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
=======
>>>>>>> apiato
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
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(FindPaymentAccountByIdTask::class, [$paymentAccountId]);
=======
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = Apiato::call('Payment@GetPaymentAccountByIdTask', [$paymentAccountId]);
>>>>>>> apiato

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $result = Apiato::call('Payment@DeletePaymentAccountTask', [$paymentAccount]);

        return $result;
    }
}
