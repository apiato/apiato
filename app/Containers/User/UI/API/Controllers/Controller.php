<?php

namespace App\Containers\User\UI\API\Controllers;

use App\Containers\User\Actions\CreateUserAction;
use App\Containers\User\Actions\DeleteUserAction;
use App\Containers\User\Actions\GetUserAction;
use App\Containers\User\Actions\ListAndSearchUsersAction;
use App\Containers\User\Actions\RegisterVisitorUserAction;
use App\Containers\User\Actions\SwitchVisitorToUserAction;
use App\Containers\User\Actions\UpdateUserAction;
use App\Containers\User\Actions\UpdateVisitorUserAction;
use App\Containers\User\UI\API\Requests\DeleteUserRequest;
use App\Containers\User\UI\API\Requests\RegisterRequest;
use App\Containers\User\UI\API\Requests\RegisterVisitorRequest;
use App\Containers\User\UI\API\Requests\UpdateUserRequest;
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
        $action->run();

        return $this->response->accepted(null, [
            'message' => 'User (' . $request->user()->id . ') Deleted Successfully.',
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
     * @param \Dingo\Api\Http\Request                    $request
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
     * @param \App\Containers\User\UI\API\Requests\RegisterVisitorRequest $request
     * @param \App\Containers\User\Actions\RegisterVisitorUserAction      $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerVisitor(RegisterVisitorRequest $request, RegisterVisitorUserAction $action)
    {
        $user = $action->run($request->header('visitor-id'));

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * @param \App\Containers\User\UI\API\Requests\RegisterRequest $request
     * @param \App\Containers\User\Actions\CreateUserAction        $createUserAction
     * @param \App\Containers\User\Actions\UpdateVisitorUserAction $updateVisitorUserAction
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function registerUser(
        RegisterRequest $request,
        CreateUserAction $createUserAction,
        UpdateVisitorUserAction $updateVisitorUserAction
    ) {

        $visitorId = $request->header('visitor-id');

        // if visitor ID is given then try to find that user and update it's record
        if ($visitorId) {
            $user = $updateVisitorUserAction->run(
                $visitorId,
                $request['email'],
                $request['password'],
                $request['name'],
                $request['gender'],
                $request['birth']
            );
        }

        // if visitor ID is not provided OR if the above code didn't find the user by his visitor ID then create new record
        if (!$visitorId || $user == null) {
            $user = $createUserAction->run(
                $request['email'],
                $request['password'],
                $request['name'],
                $request['gender'],
                $request['birth'],
                true
            );
        }

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
            $request['email'],
            $request['gender'],
            $request['birth']
        )->withToken();

        return $this->response->item($user, new UserTransformer());
    }
}
