<?php

namespace App\Containers\User\Tasks;

use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\AccountFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserByCredentialsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserByCredentialsTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask
     */
    private $apiLoginThisUserObjectTask;

    /**
     * CreateUserByCredentialsTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface        $userRepository
     * @param \App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ApiLoginThisUserObjectTask $apiLoginThisUserObjectTask
    ) {
        $this->userRepository = $userRepository;
        $this->apiLoginThisUserObjectTask = $apiLoginThisUserObjectTask;
    }

    /**
     * @param      $email
     * @param      $password
     * @param      $name
     * @param null $gender
     * @param null $birth
     * @param bool $login
     *
     * @return  mixed
     */
    public function run($email, $password, $name, $gender = null, $birth = null, $login = false)
    {
        $hashedPassword = Hash::make($password);

        try {
            // create new user
            $user = $this->userRepository->create([
                'name'     => $name,
                'email'    => $email,
                'password' => $hashedPassword,
                'gender'   => $gender,
                'birth'    => $birth,
            ]);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        if ($login) {
            // login this user using it's object and inject it's token on it
            $user = $this->apiLoginThisUserObjectTask->run($user);
        }

        return $user;
    }

}
