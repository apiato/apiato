<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Contracts\PaymentGatewayAccount;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class AssignPaymentAccountToUserTask extends Task
{

    public function __construct()
    {
        // ..
    }

    public function run(PaymentGatewayAccount $account, User $user, array $info)
    {
        try {
            return $user->paymentAccounts()->create([
                'user_id' => $user->id,
                'name' => $info['name'],
                'accountable_id' => $account->id,
                'accountable_type' => get_class($account),
            ]);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
