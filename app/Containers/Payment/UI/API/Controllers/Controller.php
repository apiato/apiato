<?php

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\Payment\Actions\FindPaymentAccountDetailsAction;
use App\Containers\Payment\Actions\GetAllPaymentAccountsAction;
use App\Containers\Payment\Actions\UpdatePaymentAccountAction;
use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\FindPaymentAccountDetails;
use App\Containers\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
use App\Containers\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Payment\UI\API\Controllers
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class Controller extends ApiController
{

    /**
     * @param GetAllPaymentAccountsRequest $request
     *
     * @return array
     */
    public function getAllPaymentAccounts(GetAllPaymentAccountsRequest $request)
    {
        $paymentAccounts = $this->call(GetAllPaymentAccountsAction::class, [$request]);

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    /**
     * @param FindPaymentAccountDetails $request
     *
     * @return array
     */
    public function findPaymentAccountDetails(FindPaymentAccountDetails $request)
    {
        $paymentAccount = $this->call(FindPaymentAccountDetailsAction::class, [$request]);

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
