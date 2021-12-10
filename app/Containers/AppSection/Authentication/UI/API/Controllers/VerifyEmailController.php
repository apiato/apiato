<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class VerifyEmailController extends ApiController
{
    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        app(VerifyEmailAction::class)->run($request);

        return $this->json(null);
    }
}
