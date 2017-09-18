<?php

namespace App\Containers\Payment\Proxies;

use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Containers\Payment\Contracts\PaymentChargerTaskInterface;
use App\Containers\Payment\Exceptions\ChargerTaskDoesNotImplementInterfaceException;
use App\Containers\Payment\Exceptions\NoChargeTaskForPaymentGatewayDefinedException;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use Illuminate\Support\Facades\App;

/**
 * Class PaymentsProxy
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class PaymentsProxy
{
    /**
     * @param ChargeableInterface $chargeable
     * @param PaymentAccount      $account
     * @param                     $amount
     * @param string|null         $currency
     *
     * @return mixed
     * @throws ChargerTaskDoesNotImplementInterfaceException
     * @throws NoChargeTaskForPaymentGatewayDefinedException
     */
    public function charge(ChargeableInterface $chargeable, PaymentAccount $account, $amount, $currency = null)
    {
        if ($currency === null) {
            $currency = config('payment.currency');
        }

        // check, if the account is owned by user to be charged
        App::make(CheckIfPaymentAccountBelongsToUserTask::class)->run($chargeable, $account);

        $task = config('payment.gateways.' . $account->accountable->getPaymentGatewaySlug() . '.charge_task', null);

        if (null === $task) {
            throw new NoChargeTaskForPaymentGatewayDefinedException();
        }

        // create the task
        $charger = App::make($task);

        // check if it implements the required interface
        if (! ($charger instanceof  PaymentChargerTaskInterface)) {
            throw new ChargerTaskDoesNotImplementInterfaceException();
        }

        $typed_account = $account->accountable;

        $result = $charger->run($chargeable, $typed_account, $amount, $currency);

        return $result;
    }
}
