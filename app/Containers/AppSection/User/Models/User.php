<?php

declare(strict_types=1);

namespace App\Containers\AppSection\User\Models;

use App\Containers\AppSection\Authorization\Enums\Role as RoleEnum;
use App\Containers\AppSection\User\Data\Collections\UserCollection;
use App\Containers\AppSection\User\Enums\Gender;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property      int                                                                                                                                             $id
 * @property      string|null                                                                                                                                     $name
 * @property      string                                                                                                                                          $email
 * @property      \Carbon\CarbonImmutable|null                                                                                                                    $email_verified_at
 * @property      string|null                                                                                                                                     $password
 * @property      Gender|null                                                                                                                                     $gender
 * @property      \Carbon\CarbonImmutable|null                                                                                                                    $birth
 * @property      string|null                                                                                                                                     $remember_token
 * @property      \Carbon\CarbonImmutable|null                                                                                                                    $created_at
 * @property      \Carbon\CarbonImmutable|null                                                                                                                    $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client>                                                                         $clients
 * @property-read int|null                                                                                                                                        $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification>                                   $notifications
 * @property-read int|null                                                                                                                                        $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client>                                                                         $oauthApps
 * @property-read int|null                                                                                                                                        $oauth_apps_count
 * @property-read \App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection<int, \App\Containers\AppSection\Authorization\Models\Permission> $permissions
 * @property-read int|null                                                                                                                                        $permissions_count
 * @property-read \App\Containers\AppSection\Authorization\Data\Collections\RoleCollection<int, \App\Containers\AppSection\Authorization\Models\Role>             $roles
 * @property-read int|null                                                                                                                                        $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token>                                                                          $tokens
 * @property-read int|null                                                                                                                                        $tokens_count
 *
 * @method static UserCollection<int, static>                                all($columns = ['*'])
 * @method static \App\Containers\AppSection\User\Data\Factories\UserFactory factory($count = null, $state = [])
 * @method static UserCollection<int, static>                                get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User         withoutRole($roles, $guard = null)
 */
final class User extends ParentUserModel
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birth',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    #[\Override]
    public function newCollection(array $models = []): UserCollection
    {
        return new UserCollection($models);
    }

    /**
     * Allows Passport to find the user by email (case-insensitive).
     */
    public function findForPassport(string $username): null|self
    {
        return self::orWhereRaw('lower(email) = lower(?)', [$username])->first();
    }

    public function isSuperAdmin(): bool
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (!$this->hasRole(RoleEnum::SUPER_ADMIN, $guard)) {
                return false;
            }
        }

        return true;
    }

    protected function email(): Attribute
    {
        return new Attribute(
            get: static fn (null|string $value): null|string => \is_null($value) ? null : strtolower($value),
        );
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'immutable_datetime',
            'password'          => 'hashed',
            'gender'            => Gender::class,
            'birth'             => 'immutable_date',
        ];
    }
}
