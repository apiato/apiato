<?php

namespace App\Containers\User\Tasks;

use App\Containers\Authentication\Tasks\ApiAuthenticationTask;
use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\AccountFailedException;
use App\Port\Task\Abstracts\Task;
use Exception;

/**
 * Class CreateUserByVisitorIdTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateUserByVisitorIdTask extends Task
{

    /**
     * @var \App\Containers\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * CreateUserByVisitorIdTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param      $visitorId device ID (example: iphone UUID, Android ID)
     * @param null $device
     * @param null $platform
     *
     * @return  mixed
     */
    public function run($visitorId, $device = null, $platform = null)
    {
        try {
            // create new user
            $user = $this->userRepository->create([
                'visitor_id' => $visitorId,
                'device'     => $device,
                'platform'   => $platform,
            ]);
        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }

}
