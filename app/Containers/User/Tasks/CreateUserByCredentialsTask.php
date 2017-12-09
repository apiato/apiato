<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserByCredentialsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserByCredentialsTask extends Task
{

    /**
     * @param bool        $isClient
     * @param string      $email
     * @param string      $password
     * @param string|null $name
     * @param string|null $gender
     * @param string|null $birth
     *
     * @return User
     * @throws CreateResourceFailedException
     */
    public function run($isClient = true, $email, $password, $name = null, $gender = null, $birth = null): User
    {
        try {
            // create new user
            return App::make(UserRepository::class)->create([
                'password'  => Hash::make($password),
                'email'     => $email,
                'name'      => $name,
                'gender'    => $gender,
                'birth'     => $birth,
                'is_client' => $isClient,
            ]);

        } catch (Exception $e) {
            throw new CreateResourceFailedException();
        }
    }

}
