<?php

namespace App\Containers\Wepay\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Wepay\UI\API\Requests\CreateWepayAccountRequest;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Transporters\DataTransporter;

/**
 * Class Controller.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Wepay\UI\API\Requests\CreateWepayAccountRequest $request
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function createWepayAccount(CreateWepayAccountRequest $request)
    {
        $wepayAccount = Apiato::call('Wepay@CreateWepayAccountAction', [new DataTransporter($request)]);

        return $this->accepted([
            'message'        => 'Wepay account created successfully.',
            'wepayAccountId' => $wepayAccount->id,
        ]);
    }

}
