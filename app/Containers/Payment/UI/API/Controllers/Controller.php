<?php

namespace App\Containers\Payment\UI\API\Controllers;

<<<<<<< HEAD
use App\Containers\Payment\Actions\DeletePaymentAccountAction;
use App\Containers\Payment\Actions\FindPaymentAccountDetailsAction;
use App\Containers\Payment\Actions\GetAllPaymentAccountsAction;
use App\Containers\Payment\Actions\UpdatePaymentAccountAction;
use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\FindPaymentAccountDetails;
use App\Containers\Payment\UI\API\Requests\GetAllPaymentAccountsRequest;
=======
use App\Containers\Payment\UI\API\Requests\DeletePaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\GetPaymentAccountRequest;
use App\Containers\Payment\UI\API\Requests\ListAllPaymentAccountsRequest;
>>>>>>> apiato
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
<<<<<<< HEAD
     * @param GetAllPaymentAccountsRequest $request
     *
     * @return array
     */
    public function getAllPaymentAccounts(GetAllPaymentAccountsRequest $request)
    {
        $paymentAccounts = $this->call(GetAllPaymentAccountsAction::class, [$request]);
=======
     * @param ListAllPaymentAccountsRequest $request
     *
     * @return array
     */
    public function listAllPaymentAccounts(ListAllPaymentAccountsRequest $request)
    {
        $paymentAccounts = Apiato::call('Payment@GetPaymentAccountsAction', [$request]);
>>>>>>> apiato

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }

    /**
<<<<<<< HEAD
     * @param FindPaymentAccountDetails $request
     *
     * @return array
     */
    public function findPaymentAccountDetails(FindPaymentAccountDetails $request)
    {
        $paymentAccount = $this->call(FindPaymentAccountDetailsAction::class, [$request]);
=======
     * @param GetPaymentAccountRequest $request
     *
     * @return array
     */
    public function getPaymentAccount(GetPaymentAccountRequest $request)
    {
        $paymentAccount = Apiato::call('Payment@GetPaymentAccountDetailsAction', [$request]);
>>>>>>> apiato

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
