<?php

namespace App\Containers\Stripe\Tasks;

use App\Containers\Stripe\Data\Repositories\StripeAccountRepository;
use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateStripeAccountTask extends Task
{

    /**
     * @param \App\Containers\Stripe\Models\StripeAccount $account
     * @param array                                       $data
     *
     * @return  mixed
     */
    public function run(StripeAccount $account, array $data)
    {
        $repository = App::make(StripeAccountRepository::class);

        try {
            return $repository->update($data, $account->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
