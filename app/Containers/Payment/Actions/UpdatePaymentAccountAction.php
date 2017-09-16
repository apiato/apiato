<?php

namespace App\Containers\Payment\Actions;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use App\Containers\Payment\Tasks\GetPaymentAccountByIdTask;
use App\Containers\Payment\Tasks\UpdatePaymentAccountTask;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdatePaymentAccountAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $paymentAccountId = $request->getInputByKey('id');
        $paymentAccount = $this->call(GetPaymentAccountByIdTask::class, [$paymentAccountId]);

        // check if this account belongs to our user
        $this->call(CheckIfPaymentAccountBelongsToUserTask::class, [$user, $paymentAccount]);

        $data = $request->sanitizeInput([
            'name'
        ]);

        $paymentAccount = $this->call(UpdatePaymentAccountTask::class, [$paymentAccount, $data]);

        return $paymentAccount;
    }
}
