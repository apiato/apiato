<?php

namespace App\Containers\User\Tasks;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\NotAuthorizedResourceException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\App;

class CheckForOwnershipTask extends Task
{

    public function __construct()
    {
        // ..
    }

    /**
     * @param object $entity            the entity to be checked
     * @param string $field             the field within the entity to be checked
     * @param User|null $user           the user to be checked against (default current user9
     */
    public function run($entity, $field = 'user_id', User $user = null)
    {
        if(!$user) {
            $user = App::make(GetAuthenticatedUserTask::class)->run();
        }

        $ownerId = $entity->__get($field);

        if($user->id != $ownerId) {
            throw new NotAuthorizedResourceException();
        }
    }
}
