<?php

namespace App\Containers\Payment\Gateway;

use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Containers\Payment\Contracts\PaymentChargerInterface;
use App\Containers\Payment\Exceptions\ChargerTaskDoesNotImplementInterfaceException;
use App\Containers\Payment\Exceptions\NoChargeTaskForPaymentGatewayDefinedException;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Models\PaymentTransaction;
use App\Containers\Payment\Tasks\CheckIfPaymentAccountBelongsToUserTask;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class PaymentsGateway
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class PaymentsGateway
{

    /**
     * @param ChargeableInterface $chargeable
     * @param PaymentAccount      $account
     * @param                     $amount
     * @param string|null         $currency
     *
     * @return PaymentTransaction
     * @throws ChargerTaskDoesNotImplementInterfaceException
     * @throws NoChargeTaskForPaymentGatewayDefinedException
     */
    public function charge(ChargeableInterface $chargeable, PaymentAccount $account, $amount, $currency = null) : PaymentTransaction
    {
        $currency = ($currency === null) ? Config::get('payment.currency') : $currency;

        // check, if the account is owned by user to be charged
        App::make(CheckIfPaymentAccountBelongsToUserTask::class)->run($chargeable, $account);

        $typedAccount = $account->accountable;

        $chargerTaskTaskName = Config::get('payment-container.gateways.' . $typedAccount->getPaymentGatewaySlug() . '.charge_task', null);

        if ($chargerTaskTaskName === null) {
            throw new NoChargeTaskForPaymentGatewayDefinedException();
        }

        // create the task
        $chargerTask = App::make($chargerTaskTaskName);

        // check if it implements the required interface
        if (!$chargerTask instanceof PaymentChargerInterface) {
            throw new ChargerTaskDoesNotImplementInterfaceException();
        }

        /** @var PaymentTransaction $transaction */
        $transaction = $chargerTask->charge($chargeable, $typedAccount, $amount, $currency);

        // now set some details of the transaction
        $transaction->user_id = $chargeable->id;
        $transaction->gateway = $typedAccount->getPaymentGatewayReadableName();
        $transaction->amount = $amount;
        $transaction->currency = $currency;

        $transaction->save();

        return $transaction;
    }
}
