<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use App\Ship\Contracts\Authorizable;
use App\Ship\Parents\Collections\EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

abstract class UserModel extends AbstractUserModel implements Authorizable
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param array<int, Model> $models
     */
    public function newCollection(array $models = []): EloquentCollection
    {
        return new EloquentCollection($models);
    }
}
