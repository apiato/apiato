<?php

namespace App\Containers\Authentication\UI\API\Controllers;

use App\Containers\Authentication\Actions\ApiLogoutAction;
use App\Containers\Authentication\UI\API\Requests\LogoutRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends ApiController
{

    /**
     * @param \App\Containers\Authentication\UI\API\Requests\LogoutRequest $request
     * @param \App\Containers\Authentication\Actions\ApiLogoutAction       $action
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request, ApiLogoutAction $action)
    {
        $action->run($request->bearerToken());

        return $this->accepted([
            'message' => 'Token revoked successfully.',
        ]);
    }

}
