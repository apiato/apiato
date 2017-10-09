<?php

namespace App\Containers\Payment\Actions;

<<<<<<< HEAD:app/Containers/Payment/Actions/GetAllPaymentAccountsAction.php
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\GetAllPaymentAccountsTask;
=======
>>>>>>> apiato:app/Containers/Payment/Actions/GetPaymentAccountsAction.php
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllPaymentAccountsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllPaymentAccountsAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
<<<<<<< HEAD:app/Containers/Payment/Actions/GetAllPaymentAccountsAction.php
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccounts = $this->call(GetAllPaymentAccountsTask::class, [], ['ordered', ['filterByUser' => [$user]]]);
=======
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccounts = Apiato::call('Payment@GetPaymentAccountsTask', [], ['ordered', ['filterByUser' => [$user]]]);
>>>>>>> apiato:app/Containers/Payment/Actions/GetPaymentAccountsAction.php

        return $paymentAccounts;
    }
}
