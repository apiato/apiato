<?php

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\Payment\Actions\GetPaymentAccountDetailsAction;
use App\Containers\Payment\Actions\GetPaymentAccountsAction;
use App\Containers\Payment\Actions\UpdatePaymentAccountAction;
use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\GetPaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\ListAllPaymentAccountsRequest;
use App\Containers\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param ListAllPaymentAccountsRequest $request
     *
     * @return array
     */
    public function listAllPaymentAccounts(ListAllPaymentAccountsRequest $request)
    {
        $paymentAccounts = $this->call(GetPaymentAccountsAction::class, [$request]);

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    /**
     * @param GetPaymentAccountRequest $request
     *
     * @return array
     */
    public function getPaymentAccount(GetPaymentAccountRequest $request)
    {
        $paymentAccount = $this->call(GetPaymentAccountDetailsAction::class, [$request]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param UpdatePaymentAccountRequest $request
     *
     * @return array
     */
    public function updatePaymentAccount(UpdatePaymentAccountRequest $request)
    {
        $paymentAccount = $this->call(UpdatePaymentAccountAction::class, [$request]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param DeletePaymentAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePaymentAccount(DeletePaymentAccountRequest $request)
    {
        $paymentAccount = $this->call(DeletePaymentAccountAction::class, [$request]);

        return $this->noContent();
    }
}
