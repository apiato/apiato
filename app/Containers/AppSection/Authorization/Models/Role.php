<?php

declare(strict_types=1);

namespace App\Containers\AppSection\Authorization\Models;

use Apiato\Core\Models\InteractsWithApiato;
use Apiato\Http\Resources\ResourceKeyAware;
use App\Containers\AppSection\Authorization\Data\Collections\RoleCollection;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property      int                                                                                                               $id
 * @property      string                                                                                                            $name
 * @property      string                                                                                                            $guard_name
 * @property      \Carbon\CarbonImmutable|null                                                                                      $created_at
 * @property      \Carbon\CarbonImmutable|null                                                                                      $updated_at
 * @property      string|null                                                                                                       $display_name
 * @property      string|null                                                                                                       $description
 * @property-read \App\Containers\AppSection\Authorization\Data\Collections\PermissionCollection<int, Permission>                   $permissions
 * @property-read int|null                                                                                                          $permissions_count
 * @property-read \App\Containers\AppSection\User\Data\Collections\UserCollection<int, \App\Containers\AppSection\User\Models\User> $users
 * @property-read int|null                                                                                                          $users_count
 *
 * @method static RoleCollection<int, static>                                         all($columns = ['*'])
 * @method static \App\Containers\AppSection\Authorization\Data\Factories\RoleFactory factory($count = null, $state = [])
 * @method static RoleCollection<int, static>                                         get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role                  withoutPermission($permissions)
 */
final class Role extends SpatieRole implements ResourceKeyAware
{
    use InteractsWithApiato;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function newCollection(array $models = []): RoleCollection
    {
        return new RoleCollection($models);
    }
}
