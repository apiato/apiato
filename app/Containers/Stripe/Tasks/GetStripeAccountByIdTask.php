<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetStripeAccountByIdTask extends Task
{

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        $repository = App::make(StripeAccountRepository::class);

        try {
            return $repository->find($id);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
