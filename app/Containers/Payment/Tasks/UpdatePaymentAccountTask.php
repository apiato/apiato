<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class UpdatePaymentAccountTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class UpdatePaymentAccountTask extends Task
{

    /**
     * @param \App\Containers\Payment\Models\PaymentAccount $account
     * @param array                                         $data
     *
     * @return mixed
     * @throws UpdateResourceFailedException
     */
    public function run(PaymentAccount $account, array $data)
    {
        $repository = App::make(PaymentAccountRepository::class);

        try {
            return $repository->update($data, $account->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
