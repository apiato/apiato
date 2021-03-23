<?php

namespace App\Containers\Stripe\Data\Repositories;

use App\Containers\Stripe\Models\StripeAccount;
use App\Ship\Parents\Repositories\Repository;

class StripeAccountRepository extends Repository
{
    public function model(): string
    {
        return StripeAccount::class;
    }
}
