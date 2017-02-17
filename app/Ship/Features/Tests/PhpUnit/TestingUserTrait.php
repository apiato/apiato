<?php

namespace App\Ship\Features\Tests\PhpUnit;

use App;
use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Models\User;
use Artisan;
use Dingo\Api\Http\Response as DingoAPIResponse;
use Illuminate\Support\Facades\Hash;

/**
 * Class TestingUserTrait.
 *
 * Tests helpers for the testing user.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TestingUserTrait
{

    /**
     * the Logged in user (client).
     *
     * @var User
     */
    public $loggedInTestingUser;

    /**
     * the Logged in admin user.
     *
     * @var User
     */
    public $loggedInTestingAdmin;


    /**
     * get teh current logged in user OR create new one if no one exist
     *
     * @param null $access
     *
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingUser($access = null)
    {
        if (!$user = $this->loggedInTestingUser) {
            $user = $this->createTestingUser($access);
        }

        return $user;
    }

    /**
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingUserWithoutPermissions()
    {
        if (!$user = $this->loggedInTestingUser) {
            $user = $this->getTestingUser(['permissions' => null, 'roles' => null]);
        }

        return $user;
    }

    /**
     * @param null $permissions
     *
     * @return  \App\Containers\User\Models\User|mixed
     */
    public function getTestingAdmin($permissions = null)
    {
        if (!$admin = $this->loggedInTestingAdmin) {
            $admin = $this->loggedInTestingAdmin = $this->createTestingUser([
                'roles'       => 'admin',
                'permissions' => $permissions,
            ]);
        }

        return $admin;
    }

    /**
     * get teh current logged in user token.
     *
     * @return string
     */
    public function getLoggedInTestingUserToken()
    {
        return $this->getTestingUser()->token;
    }

    /**
     * @param null $access
     * @param null $userDetails
     *
     * @return  mixed
     */
    public function createTestingUser($access = null, $userDetails = null)
    {
        // if no user detail provided, use the default details.
        $userDetails = $userDetails ? : [
            'name'     => 'Testing User',
            'email'    => $this->faker->email,
            'password' => 'testing-pass',
        ];

        // create new user and login
        $user = factory(User::class)->create([
            'email'    => $userDetails['email'],
            'password' => Hash::make($userDetails['password']),
            'name'     => $userDetails['name'],
        ]);

        // assign roles and permissions
        $user = $this->setupTestingUserAccess($user, $access ? : (isset($this->access) ? $this->access : null));

        // log the user in
        $user = App::make(ApiLoginThisUserObjectTask::class)->run($user);

        return $this->loggedInTestingUser = $user;
    }

    /**
     * @param $user
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingUserAccess($user, $access)
    {
        if (isset($access['permissions']) && !empty($access['permissions'])) {
            $user->givePermissionTo($access['permissions']);
        }
        if (isset($access['roles']) && !empty($access['roles'])) {
            if (!$user->hasRole($access['roles'])) {
                $user->assignRole($access['roles']);
            }
        }

        return $user;
    }

}
