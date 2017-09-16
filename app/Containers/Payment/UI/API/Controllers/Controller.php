<?php

namespace App\Containers\Payment\UI\API\Controllers;

use App\Containers\Payment\Actions\GetPaymentAccountsAction;
use App\Containers\Payment\UI\API\Requests\GetPaymentAccountsRequest;
use App\Containers\Payment\UI\API\Transformers\PaymentAccountTransformer;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{
    public function getPaymentAccounts(GetPaymentAccountsRequest $request)
    {
        $paymentAccounts = $this->call(GetPaymentAccountsAction::class, [$request]);

        return $this->transform($paymentAccounts, PaymentAccountTransformer::class);
    }
}
