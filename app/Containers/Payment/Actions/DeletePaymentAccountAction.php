<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\DeletePaymentAccountTask;
use App\Containers\Payment\Tasks\GetPaymentAccountByIdTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class DeletePaymentAccountAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class DeletePaymentAccountAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(GetPaymentAccountByIdTask::class, [$paymentAccountId]);

        // check if this account belongs to our user
        $this->call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        $result = $this->call(DeletePaymentAccountTask::class, [$paymentAccount]);

        return $result;
    }
}
