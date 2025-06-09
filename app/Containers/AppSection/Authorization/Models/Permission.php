<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Models\InteractsWithApiato;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @property      int                                                                                                               $id
 * @property      string                                                                                                            $name
 * @property      string                                                                                                            $guard_name
 * @property      \Carbon\CarbonImmutable|null                                                                                      $created_at
 * @property      \Carbon\CarbonImmutable|null                                                                                      $updated_at
 * @property      string|null                                                                                                       $display_name
 * @property      string|null                                                                                                       $description
 * @property-read PermissionCollection<int, Permission>                                                                             $permissions
 * @property-read int|null                                                                                                          $permissions_count
 * @property-read \App\Containers\AppSection\Authorization\Data\Collections\RoleCollection<int, Role>                               $roles
 * @property-read int|null                                                                                                          $roles_count
 * @property-read \App\Containers\AppSection\User\Data\Collections\UserCollection<int, \App\Containers\AppSection\User\Models\User> $users
 * @property-read int|null                                                                                                          $users_count
 *
 * @method static PermissionCollection<int, static>                                         all($columns = ['*'])
 * @method static \App\Containers\AppSection\Authorization\Data\Factories\PermissionFactory factory($count = null, $state = [])
 * @method static PermissionCollection<int, static>                                         get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission                  withoutRole($roles, $guard = null)
 */
final class Permission extends SpatiePermission implements ResourceKeyAware
{
    use InteractsWithApiato;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): PermissionCollection
    {
        return new PermissionCollection($models);
    }
}
