<?php

namespace Apiato\Core\Traits\TestsTraits\PhpUnit;

use App;
use App\Containers\Authentication\Tasks\ApiLoginThisUserObjectTask;
use App\Containers\User\Models\User;
use Artisan;
use Illuminate\Support\Facades\Hash;

/**
 * Class TestsAuthHelperTrait.
 *
 * Tests helper for authentication and authorization.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait TestsAuthHelperTrait
{

    /**
     * Logged in user object.
     *
     * @var User
     */
    protected $testingUser;

    /**
     * Roles and permissions, to be attached on the user
     *
     * @var array
     */
    protected $access = [
        'permissions' => '',
        'roles'       => '',
    ];

    /**
     * Try to get the last logged in User, if not found then create new one.
     * Note: if $userDetails are provided it will always create new user, even
     * if another one was previously created during the execution of your test.
     *
     * By default Users will be given the Roles and Permissions found int he class
     * `$access` property. But the $access parameter can be used to override the
     * defined roles and permissions in the `$access` property of your class.
     *
     * @param null $access      roles and permissions you'd like to provide this user with
     * @param null $userDetails what to be attached on the User object
     *
     * @return  \App\Containers\User\Models\User
     */
    public function getTestingUser($userDetails = null, $access = null)
    {
        return is_null($userDetails) ? $this->findOrCreateTestingUser($userDetails, $access)
            : $this->createTestingUser($userDetails, $access);
    }

    /**
     * Same as `getTestingUser()` but always overrides the User Access
     * (roles and permissions) with null. So the user can be used to test
     * if unauthorized user tried to access your protected endpoint.
     *
     * @param null $userDetails
     *
     * @return  \App\Containers\User\Models\User
     */
    public function getTestingUserWithoutAccess($userDetails = null)
    {
        return $this->getTestingUser($userDetails, $this->getNullAccess());
    }

    /**
     * @param $userDetails
     * @param $access
     *
     * @return  \App\Containers\User\Models\User
     */
    private function findOrCreateTestingUser($userDetails, $access)
    {
        return $this->testingUser ? : $this->createTestingUser($userDetails, $access);
    }

    /**
     * @param null $access
     * @param null $userDetails
     *
     * @return  User
     */
    private function createTestingUser($userDetails = null, $access = null)
    {
        // "inject" the confirmed status, if userdetails are submitted
        if(is_array($userDetails)) {
            $defaults = [
                'confirmed' => true,
            ];

            $userDetails = array_merge($defaults, $userDetails);
        }

        // create new user
        $user = $this->factoryCreateUser($userDetails);

        // assign user roles and permissions based on the access property
        $user = $this->setupTestingUserAccess($user, $access);

        // authentication the user
        $this->actingAs($user, 'api');

        // set the created user
        return $this->testingUser = $user;
    }

    /**
     * @param null $userDetails
     *
     * @return  User
     */
    private function factoryCreateUser($userDetails = null)
    {
        return factory(User::class)->create($this->prepareUserDetails($userDetails));
    }

    /**
     * @param null $userDetails
     *
     * @return  array
     */
    private function prepareUserDetails($userDetails = null)
    {
        $defaultUserDetails = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => 'testing-password',
        ];

        // if no user detail provided, use the default details, to find the password or generate one before encoding it
        return $this->prepareUserPassword($userDetails ? : $defaultUserDetails);;
    }

    /**
     * @param $userDetails
     *
     * @return  null
     */
    private function prepareUserPassword($userDetails)
    {
        // get password from the user details or generate one
        $password = isset($userDetails['password']) ? $userDetails['password'] : $this->faker->password;

        // hash the password and set it back at the user details
        $userDetails['password'] = Hash::make($password);

        return $userDetails;
    }


    /**
     * @return  array|null
     */
    private function getAccess()
    {
        return isset($this->access) ? $this->access : null;
    }

    /**
     * @param $user
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingUserAccess($user, $access = null)
    {
        $access = $access ? : $this->getAccess();

        $user = $this->setupTestingUserPermissions($user, $access);
        $user = $this->setupTestingUserRoles($user, $access);

        return $user;
    }

    /**
     * @param $user
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingUserRoles($user, $access)
    {
        if (isset($access['roles']) && !empty($access['roles'])) {
            if (!$user->hasRole($access['roles'])) {
                $user->assignRole($access['roles']);
                $user = $user->fresh();
            }
        }

        return $user;
    }

    /**
     * @param $user
     * @param $access
     *
     * @return  mixed
     */
    private function setupTestingUserPermissions($user, $access)
    {
        if (isset($access['permissions']) && !empty($access['permissions'])) {
            $user->givePermissionTo($access['permissions']);
            $user = $user->fresh();
        }

        return $user;
    }


    /**
     * @return  array
     */
    private function getNullAccess()
    {
        return [
            'permissions' => null,
            'roles'       => null
        ];
    }

}
