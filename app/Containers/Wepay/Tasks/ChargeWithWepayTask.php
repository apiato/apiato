<?php

namespace App\Containers\Wepay\Tasks;

use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Containers\Payment\Contracts\PaymentChargerInterface;
use App\Containers\Payment\Models\AbstractPaymentAccount;
use App\Containers\Wepay\Exceptions\WepayApiErrorException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Config;
use KevinEm\WePay\Laravel\WePayLaravel;

/**
 * Class ChargeWithWepayTask
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ChargeWithWepayTask extends Task implements PaymentChargerInterface
{

    public $wepayLaravel;

    /**
     * WepayApi constructor.
     *
     * @param \KevinEm\WePay\Laravel\WePayLaravel $wepayLaravel
     */
    public function __construct(WePayLaravel $wepayLaravel)
    {
        $this->wepayLaravel = $wepayLaravel->make(
            Config::get('wepay-container.client_secret'),
            Config::get('wepay-container.version')
        );
    }

    /**
     * @param \App\Containers\Payment\Contracts\ChargeableInterface $user
     * @param \App\Containers\Payment\Models\AbstractPaymentAccount $account
     * @param float                                                 $amount
     * @param string                                                $currency
     *
     * @return array|null
     * @throws WepayApiErrorException
     */
    public function charge(ChargeableInterface $user, AbstractPaymentAccount $account, $amount, $currency = 'USD')
    {
//        $valid = $account->checkIfPaymentDataIsSet([...]);
//
//        if(!$valid){
//            throw new WepayAccountNotFoundException('We could not find your credit card information.
//            For security reasons, we do not store your credit card information on our server.
//            So please login to our Web App and enter your credit card information directly into Stripe,
//            then try to purchase the credits again.
//            Thanks.');
//        }

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
