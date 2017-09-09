<?php

namespace App\Containers\Wepay\Tasks;

use App\Containers\Wepay\Exceptions\WepayAccountNotFoundException;
use App\Containers\Wepay\Exceptions\WepayApiErrorException;
use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

use KevinEm\WePay\Laravel\WePayLaravel;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class ChargeWithWepayTask.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class ChargeWithWepayTask extends Task
{

    public $wepayLaravel;

    /**
     * WepayApi constructor.
     *
     * @param \KevinEm\WePay\Laravel\WePayLaravel $wepayLaravel
     */
    public function __construct(WePayLaravel $wepayLaravel)
    {
        $this->wepayLaravel = $wepayLaravel->make(Config::get('services.wepay.client_secret'), Config::get('services.wepay.version'));
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
        $stripeAccount = $user->stripeAccount;

        if(!$wepayAccount){
            throw new WepayAccountNotFoundException('We could not find your credit card information. 
            For security reasons, we do not store your credit card information on our server. 
            So please login to our Web App and enter your credit card information directly into Stripe, 
            then try to purchase the credits again. 
            Thanks.');
        }

        try {

            $response = $this->wepayLaravel->charges()->create([
                'customer' => $user->wepayAccount->customer_id,
                'currency' => $currency,
                'amount'   => $amount,
            ]);

        } catch (Exception $e) {
            throw (new WepayApiErrorException('Wepay API error (chargeCustomer)'))->debug($e->getMessage(), true);
        }

        if ($response['status'] != 'succeeded') {
            throw new WepayApiErrorException('Wepay response status not succeeded (chargeCustomer)');
        }

        if ($response['paid'] !== true) {
            return null;
        }

        // this data will be stored on the pivot table (user credits)
        return [
            'payment_method' => 'Wepay',
            'description'    => $response['id'] // the charge id
        ];
    }

}
