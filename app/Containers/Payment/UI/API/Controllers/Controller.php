<?php

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\FindPaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
use App\Containers\Payment\UI\API\Requests\UpdatePaymentAccountRequest;
use App\Containers\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class Controller
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
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
        $paymentAccounts = Apiato::call('Payment@FindPaymentAccountsAction', [$request]);

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    /**
     * @param FindPaymentAccountRequest $request
     *
     * @return array
     */
    public function getPaymentAccount(FindPaymentAccountRequest $request)
    {
        $paymentAccount = Apiato::call('Payment@FindPaymentAccountDetailsAction', [$request]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param UpdatePaymentAccountRequest $request
     *
     * @return array
     */
    public function updatePaymentAccount(UpdatePaymentAccountRequest $request)
    {
        $paymentAccount = Apiato::call('Payment@UpdatePaymentAccountAction', [$request]);

        return $this->transform($paymentAccount, PaymentAccountTransformer::class);
    }

    /**
     * @param DeletePaymentAccountRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePaymentAccount(DeletePaymentAccountRequest $request)
    {
        $paymentAccount = Apiato::call('Payment@DeletePaymentAccountAction', [$request]);

        return $this->noContent();
    }
}
