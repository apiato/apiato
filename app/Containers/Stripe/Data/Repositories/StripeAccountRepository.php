<?php

namespace App\Containers\Stripe\Data\Repositories;

use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Parents\Repositories\Repository;

/**
 * Class StripeAccountRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class StripeAccountRepository extends Repository
{

    /**
     * the container name. Must be set when the model has different name than the container
     *
     * @var  string
     */
    protected $container = 'Stripe';

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return StripeAccount::class;
    }
}
