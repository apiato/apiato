<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\VerifyEmailAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\VerifyEmailRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class VerifyEmailController extends ApiController
{
    public function __construct(
        private readonly VerifyEmailAction $verifyEmailAction
    ) {
    }

    public function __invoke(VerifyEmailRequest $request): JsonResponse
    {
        $this->verifyEmailAction->run($request);

        return $this->json(null);
    }
}
