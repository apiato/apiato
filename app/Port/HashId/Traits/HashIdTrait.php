<?php

namespace App\Port\HashId\Traits;

use Illuminate\Support\Facades\Config;
use Route;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class HashIdTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait HashIdTrait
{

    /**
     * All ID's passed with all endpoints will be decoded before entering the Application
     */
    public function runEndpointsHashedIdsDecoder()
    {
        if (Config::get('hello.hash-id')) {
            Route::bind('id', function ($id, $route) {
                return Hashids::decode($id)[0];
            });
        }
    }


    /**
     * Will be used by the Eloquent Models (since it's used as trait there).
     *
     * @return  mixed
     */
    public function getHashedKey()
    {
        // hash the ID only if hash-id enabled in the config
        if (Config::get('hello.hash-id')) {
            return Hashids::encode($this->getKey());
        }

        return $this->getKey();
    }

}
