<?php

namespace App\Containers\Stripe\Repositories\Eloquent;

use App\Containers\Stripe\Models\StripeAccount;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class StripeAccountRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class StripeAccountRepository extends Repository
{

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
