<?php

namespace App\Containers\Payment\Tasks;

use App\Containers\Payment\Data\Repositories\PaymentAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class FindPaymentAccountByIdTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FindPaymentAccountByIdTask extends Task
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
