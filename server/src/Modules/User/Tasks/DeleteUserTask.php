<?php

namespace Mega\Modules\User\Tasks;

use Mega\Modules\User\Contracts\UserRepositoryInterface;
use Mega\Services\Core\Task\Abstracts\Task;

/**
 * Class DeleteUserTask
 *
 * @type     Task
 * @package  Mega\Services\User\Tasks
 * @author   Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteUserTask extends Task
{

    /**
     * @var \Mega\Modules\User\Contracts\UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserTask constructor.
     *
     * @param \Mega\Modules\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param      $userId
     * @param null $password
     * @param null $name
     *
     * @return mixed
     */
    public function run($userId)
    {
        // delete the record from the users table.
        $this->userRepository->delete($userId);

        return true;
    }


}
