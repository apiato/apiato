<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Tasks\SendVerificationEmailTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\SendVerificationEmailRequest;
use App\Ship\Parents\Actions\Action;

class SendVerificationEmailAction extends Action
{
    public function run(SendVerificationEmailRequest $request): void
    {
        app(SendVerificationEmailTask::class)->run($request->user());
    }
}
