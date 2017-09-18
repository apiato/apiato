<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class GetPaymentAccountByIdTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetPaymentAccountByIdTask extends Task
{

    public function run($id)
    {
        $repository = App::make(PaymentAccountRepository::class);

        try {
            return $repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
