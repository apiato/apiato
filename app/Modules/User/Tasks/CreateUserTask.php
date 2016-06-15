<?php

namespace App\Modules\User\Tasks;

use Exception;
use Illuminate\Support\Facades\Hash;
use App\Modules\User\Contracts\UserRepositoryInterface;
use App\Modules\User\Exceptions\AccountFailedException;
use App\Services\Authentication\Portals\AuthenticationService;
use App\Modules\Core\Task\Abstracts\Task;

/**
 * Class CreateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserTask extends Task
{

    /**
     * @var \App\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var \App\Services\Authentication\Portals\AuthenticationService
     */
    private $authenticationService;

    /**
     * CreateUserTask constructor.
     *
     * @param \App\Modules\User\Contracts\UserRepositoryInterface        $userRepository
     * @param \App\Services\Authentication\Portals\AuthenticationService $authenticationService
     */
    public function __construct(UserRepositoryInterface $userRepository, AuthenticationService $authenticationService)
    {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
    }

    /**
     * create a new user object.
     * optionally can login the created user and return it with its token.
     *
     * @param      $email
     * @param      $password
     * @param      $name
     * @param bool $login determine weather to login or not after creating
     *
     * @return mixed
     */
    public function run($email, $password, $name, $login = false)
    {
        $hashedPassword = Hash::make($password);

        try {
            // create new user
            $user = $this->userRepository->create([
                'email'    => $email,
                'password' => $hashedPassword,
                'name'     => $name,
            ]);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        if ($login) {
            // login this user using it's object and inject it's token on it
            $user = $this->authenticationService->loginFromObject($user);
        }

        return $user;
    }
}
