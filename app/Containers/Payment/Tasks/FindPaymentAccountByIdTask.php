<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class FindPaymentAccountByIdTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class FindPaymentAccountByIdTask extends Task
{

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id): PaymentAccount
    {
        $repository = App::make(PaymentAccountRepository::class);

        try {
            $paymentAccount = $repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }

        return $paymentAccount;
    }
}
