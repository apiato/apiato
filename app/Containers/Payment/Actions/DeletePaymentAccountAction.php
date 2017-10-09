<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\Payment\Tasks\FindPaymentAccountByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

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
        $user = $this->call(FindAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(FindPaymentAccountByIdTask::class, [$paymentAccountId]);

        // check if this account belongs to our user
        $this->call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        $result = $this->call(DeletePaymentAccountTask::class, [$paymentAccount]);

        return $result;
    }
}
