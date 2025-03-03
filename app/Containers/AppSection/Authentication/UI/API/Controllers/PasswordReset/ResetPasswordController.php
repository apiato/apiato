<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers\PasswordReset;

use Apiato\Support\Facades\Response;
use App\Containers\AppSection\Authentication\Actions\PasswordReset\ResetPasswordAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\PasswordReset\ResetPasswordRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

final class ResetPasswordController extends ApiController
{
    public function __invoke(ResetPasswordRequest $request, ResetPasswordAction $action): JsonResponse
    {
        $status = $action->run($request);

        return Response::ok($status);
    }
}
