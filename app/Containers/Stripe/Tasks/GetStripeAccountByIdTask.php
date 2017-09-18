<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetStripeAccountByIdTask extends Task
{
    private $repository;

    public function __construct(StripeAccountRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
