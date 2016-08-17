<?php

namespace App\Containers\User\Tasks;

use App\Containers\ApiAuthentication\Tasks\ApiAuthenticationTask;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\AccountFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserTask extends Task
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
     * CreateUserTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface              $userRepository
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
    public function byCredentials($email, $password, $name, $login = false)
    {
        $hashedPassword = Hash::make($password);

        // create new user
        $user = $this->create([
            'name'     => $name,
            'email'    => $email,
            'password' => $hashedPassword,
        ]);

        if ($login) {
            // login this user using it's object and inject it's token on it
            $user = $this->authenticationTask->loginFromObject($user);
        }

        return $user;
    }

    /**
     * @param      $visitorId device ID (example: iphone UUID, Android ID)
     * @param null $device
     * @param null $platform
     *
     * @return  mixed
     */
    public function byVisitor($visitorId, $device = null, $platform = null)
    {
        // create new user
        $user = $this->create([
            'visitor_id' => $visitorId,
            'device'     => $device,
            'platform'   => $platform,
        ]);

        return $user;
    }


    /**
     * @param $data
     *
     * @return  mixed
     */
    private function create($data)
    {
        try {
            // create new user
            $user = $this->userRepository->create($data);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }

}
