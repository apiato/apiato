<?php

namespace App\Ship\Parents\Models;

use Apiato\Core\Abstracts\Models\UserModel as AbstractUserModel;
use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class UserModel.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class UserModel extends AbstractUserModel
{

    use Notifiable;
    use SoftDeletes;
    use HashIdTrait;
    use HasRoles;
    use HasApiTokens;
    use HasResourceKeyTrait;

    public function findForPassport($identifier)
    {
        $allowedLoginAttributes = config('authentication-container.login.allowed_login_attributes', ['email' => []]);
        $fields = array_keys($allowedLoginAttributes);

        $builder = $this;

        foreach ($fields as $field)
        {
            $builder = $builder->orWhere($field, $identifier);
        }

        $builder = $builder->first();

        return $builder;
    }

}
