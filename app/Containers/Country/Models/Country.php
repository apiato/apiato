<?php

namespace App\Containers\Country\Models;

use App\Containers\Reward\Models\Reward;
use App\Containers\User\Models\User;
use Webpatser\Countries\Countries;

/**
 * Class Country.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Country extends Countries
{

    public function rewards()
    {
        return $this->belongsToMany(Reward::class);
    }

    /**
     * for the currency
     */
    public function reward()
    {
        return $this->hasOne(Reward::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
