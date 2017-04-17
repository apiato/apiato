<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Exceptions\AccountFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\App;
use App\Containers\User\Data\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserByCredentialsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserByCredentialsTask extends Task
{

    /**
     * @param      $email
     * @param      $password
     * @param null $name
     * @param null $gender
     * @param null $birth
     *
     * @return  mixed
     */
    public function run($email, $password, $name = null, $gender = null, $birth = null)
    {
        try {
            // create new user
            $user = App::make(UserRepository::class)->create([
                'password' => Hash::make($password),
                'email'    => $email,
                'name'     => $name,
                'gender'   => $gender,
                'birth'    => $birth,
            ]);

        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }

}
