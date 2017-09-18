<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Models\AbstractPaymentGatewayAccount;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

/**
 * Class AssignPaymentAccountToUserTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class AssignPaymentAccountToUserTask extends Task
{

    /**
     * @param \App\Containers\Payment\Models\AbstractPaymentGatewayAccount $account
     * @param \App\Containers\User\Models\User                             $user
     * @param array                                                        $info
     *
     * @return  \Illuminate\Database\Eloquent\Model
     */
    public function run(AbstractPaymentGatewayAccount $account, User $user, array $info)
    {
        try {
            return $user->paymentAccounts()->create([
                'user_id'          => $user->id,
                'name'             => $info['name'],
                'accountable_id'   => $account->id,
                'accountable_type' => get_class($account),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
