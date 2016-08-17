<?php

namespace App\Containers\User\Tasks;

use App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask;
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
     * @var \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask
     */
    private $authenticationTask;

    /**
     * CreateUserByCredentialsTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface        $userRepository
     * @param \App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask $authenticationTask
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ApiAuthenticationTask $authenticationTask
    ) {
        $this->userRepository = $userRepository;
        $this->authenticationTask = $authenticationTask;
    }

    /**
     * @param            $email
     * @param            $password
     * @param            $name
     * @param bool|false $login
     *
     * @return  mixed
     */
    public function run($email, $password, $name, $login = false)
    {
        $hashedPassword = Hash::make($password);

        try {
            // create new user
            $user = $this->userRepository->create([
                'name'     => $name,
                'email'    => $email,
                'password' => $hashedPassword,
            ]);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        if ($login) {
            // login this user using it's object and inject it's token on it
            $user = $this->authenticationTask->loginFromObject($user);
        }

        return $user;
    }

}
