<?php

namespace App\Containers\User\Services;

use App\Containers\ApiAuthentication\Services\ApiAuthenticationService;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\AccountFailedException;
use App\Port\Service\Abstracts\Service;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateUserService.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserService extends Service
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var \App\Containers\ApiAuthentication\Services\ApiAuthenticationService
     */
    private $authenticationService;

    /**
     * CreateUserService constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface              $userRepository
     * @param \App\Containers\ApiAuthentication\Services\ApiAuthenticationService $authenticationService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ApiAuthenticationService $authenticationService
    ) {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
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
            $user = $this->authenticationService->loginFromObject($user);
        }

        return $user;
    }

    /**
     * @param      $agentId device ID (example: iphone UUID, Android ID)
     * @param null $device
     * @param null $platform
     *
     * @return  mixed
     */
    public function byAgent($agentId, $device = null, $platform = null)
    {
        try {
            // create new user
            $user = $this->userRepository->create([
                'agent_id' => $agentId,
                'device'   => $device,
                'platform' => $platform,
            ]);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }

}
