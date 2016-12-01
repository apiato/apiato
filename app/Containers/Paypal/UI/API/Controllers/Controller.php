<?php

namespace App\Containers\Paypal\UI\API\Controllers;

use App\Containers\Paypal\Actions\CreatePaypalAccountAction;
use App\Containers\Paypal\UI\API\Requests\CreatePaypalAccountRequest;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Paypal\UI\API\Requests\CreatePaypalAccountRequest $request
     * @param \App\Containers\Paypal\Actions\CreatePaypalAccountAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function createPaypalAccount(CreatePaypalAccountRequest $request, CreatePaypalAccountAction $action)
    {
        $paypalAccount = $action->run(
            $request->user(),
            'some_id' // TODO: To Be Continue...
        );

        return $this->response->accepted(null, [
            'message'           => 'Paypal account created successfully.',
            'paypal_account_id' => $paypalAccount->id,
        ]);
    }

}
