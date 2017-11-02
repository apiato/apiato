<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

class CreateStripeAccountTask extends Task
{

    /**
     * @param array $data
     *
     * @return mixed
     * @throws CreateResourceFailedException
     */
    public function run(array $data)
    {
        $repository = App::make(StripeAccountRepository::class);

        try {
            return $repository->create($data);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
