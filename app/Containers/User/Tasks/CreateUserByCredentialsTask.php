<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Contracts\UserRepositoryInterface;
use App\Containers\User\Exceptions\AccountFailedException;
use App\Ship\Parents\Tasks\Task;
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
     * CreateUserByCredentialsTask constructor.
     *
     * @param \App\Containers\User\Contracts\UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param      $email
     * @param      $password
     * @param      $name
     * @param null $gender
     * @param null $birth
     *
     * @return  mixed
     */
    public function run($email, $password, $name = null, $gender = null, $birth = null)
    {
        try {
            // create new user
            $user = $this->userRepository->create([
                'name'     => $name,
                'email'    => $email,
                'password' => $this->hashPass($password),
                'gender'   => $gender,
                'birth'    => $birth,
            ]);

        } catch (Exception $e) {
            throw (new AccountFailedException())->debug($e);
        }

        return $user;
    }

    /**
     * TODO: remove from here
     *
     * @param $password
     *
     * @return  mixed
     */
    private function hashPass($password)
    {
        return Hash::make($password);
    }

}
