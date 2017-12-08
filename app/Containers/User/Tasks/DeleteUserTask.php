<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;

/**
 * Class DeleteUserTask
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

    /**
     *
     * @param User $user
     *
     * @return bool
     * @throws DeleteResourceFailedException
     */
    public function run(User $user)
    {
        try {
            return App::make(UserRepository::class)->delete($user->id);
        }
        catch (Exception $exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
