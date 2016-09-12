<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\ListAndSearchUsersAction;
use App\Containers\User\Actions\SwitchVisitorToUserAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
use App\Containers\User\UI\API\Requests\UpdateVisitorUserRequest;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Port\Controller\Abstracts\PortApiController;
use Dingo\Api\Http\Request;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\User\UI\API\Requests\DeleteUserRequest $request
     * @param \App\Containers\User\Actions\DeleteUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function deleteUser(DeleteUserRequest $request, DeleteUserAction $action)
    {
        $action->run($request->id);

        return $this->response->accepted(null, [
            'message' => 'User (' . $request->id . ') Deleted Successfully.',
        ]);
    }

    /**
     * @param \App\Containers\User\Actions\ListAndSearchUsersAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllUsers(ListAndSearchUsersAction $action)
    {
        $users = $action->run();

        return $this->response->paginator($users, new UserTransformer());
    }

    /**
     * @param \Dingo\Api\Http\Request                     $request
     * @param \App\Containers\User\Actions\GetUserAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function refreshUser(Request $request, GetUserAction $action)
    {
        $user = $action->run(
            $request['user_id'],
            $request->header('visitor-id'),
            $request->header('Authorization')
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\RegisterRequest $request
     * @param \App\Containers\User\Actions\CreateUserAction        $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(RegisterRequest $request, CreateUserAction $action)
    {
        // create and login (true parameter) the new user
        $user = $action->run(
            $request['email'],
            $request['password'],
            $request['name'],
            true
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * The Visitor is the user that was previously created by an visitor ID (A.K.A Device ID).
     * The Visitor user usually gets created automatically by a Middleware.
     *
     * @param \App\Containers\User\UI\API\Requests\UpdateVisitorUserRequest $request
     * @param \App\Containers\User\Actions\SwitchVisitorToUserAction        $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerVisitorUser(UpdateVisitorUserRequest $request, SwitchVisitorToUserAction $action)
    {
        $user = $action->run(
            $request->header('Visitor-Id'),
            $request['email'],
            $request['password'],
            $request['name']
        );

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\UpdateUserRequest $request
     * @param \App\Containers\User\Actions\UpdateUserAction          $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function updateUser(UpdateUserRequest $request, UpdateUserAction $action)
    {
        $user = $action->run(
            $request['password'],
            $request['name'],
            $request['email']
        );

        return $this->response->item($user, new UserTransformer());
    }
}
