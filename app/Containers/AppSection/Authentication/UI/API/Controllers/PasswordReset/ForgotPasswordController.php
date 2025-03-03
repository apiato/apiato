<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\PasswordReset\ForgotPasswordAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ForgotPasswordRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ForgotPasswordController extends ApiController
{
    public function __invoke(ForgotPasswordRequest $request, ForgotPasswordAction $action): JsonResponse
    {
        $status = $action->run($request);

        return Response::accepted($status);
    }
}
