<?php

namespace App\Containers\Country\Models;

use App\Containers\User\Models\User;
use Webpatser\Countries\Countries;

/**
 * Class Country.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Country extends Countries
{

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
