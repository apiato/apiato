<?php

namespace App\Containers\User\Actions;

<<<<<<< HEAD:app/Containers/User/Actions/FindMyProfileAction.php
use App\Containers\Authentication\Tasks\FindAuthenticatedUserTask;
=======
>>>>>>> apiato:app/Containers/User/Actions/GetMyProfileAction.php
use App\Containers\User\Exceptions\UserNotFoundException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

<<<<<<< HEAD:app/Containers/User/Actions/FindMyProfileAction.php
class FindMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = $this->call(FindAuthenticatedUserTask::class);
=======
/**
 * Class GetMyProfileAction
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class GetMyProfileAction extends Action
{
    public function run(Request $request)
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');
>>>>>>> apiato:app/Containers/User/Actions/GetMyProfileAction.php

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
