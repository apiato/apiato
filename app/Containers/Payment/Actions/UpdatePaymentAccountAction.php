<?php

namespace App\Containers\Payment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Ship\Parents\Actions\Action;

class UpdatePaymentAccountAction extends Action
{
    public function run(UpdatePaymentAccountRequest $data): PaymentAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $paymentAccount = Apiato::call('Payment@FindPaymentAccountByIdTask', [$data->id]);

        // check if this account belongs to our user
        Apiato::call('Payment@CheckIfPaymentAccountBelongsToUserTask', [$user, $paymentAccount]);

        $sanitizedData = $data->sanitizeInput([
            'name'
        ]);

        $paymentAccount = Apiato::call('Payment@UpdatePaymentAccountTask', [$paymentAccount, $sanitizedData]);

        return $paymentAccount;
    }
}
