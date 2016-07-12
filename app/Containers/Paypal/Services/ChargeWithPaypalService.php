<?php

namespace App\Containers\Paypal\Services;

use App\Containers\User\Models\User;
use App\Port\Service\Abstracts\Service;
use App\Portainers\Payments\Contracts\Chargeable;

/**
 * Class ChargeWithPaypalService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ChargeWithPaypalService extends Service implements Chargeable
{

    public $stripe;

    /**
     * ChargeWithPaypalService constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  array|null
     */
    public function run(User $user, $amount, $currency = 'USD')
    {

        // this data will be stored on the pivot table (user credits)
        return [
            'payment_method' => 'paypal',
            'description'    => 'cool'
        ];
    }

    /**
     * @param \App\Containers\User\Models\User $user
     * @param                                  $amount
     * @param string                           $currency
     *
     * @return  array|null
     */
    public function charge(User $user, $amount, $currency = 'USD')
    {
        return $this->run($user, $amount, $currency);
    }

}
