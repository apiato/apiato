<?php

namespace App\Containers\AppSection\User\UI\WEB\Controllers;

use Apiato\Core\Traits\ResponseTrait;
use App\Containers\AppSection\User\Actions\ListUsersAction;
use App\Containers\AppSection\User\UI\API\Requests\ListUsersRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\WebController;
use Inertia\Inertia;
use Inertia\Response;

class IndexUsersController extends WebController
{
    use ResponseTrait;

    public function __invoke(ListUsersRequest $request, ListUsersAction $action): Response
    {
        return Inertia::render('appSection@user::IndexUsersPage', $this->transform($action->run(), UserTransformer::class));
    }
}
