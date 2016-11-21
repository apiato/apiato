<?php

namespace App\Port\Model\Abstracts;

use Illuminate\Database\Eloquent\Model as LaravelEloquentModel;
use Illuminate\Support\Facades\Config;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class Model.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Model extends LaravelEloquentModel
{

    public function getHashedKey()
    {
        // hash the ID only if hash-id enabled in the config
        if (Config::get('hello.hash-id')) {
            return Hashids::encode($this->getKey());
        }

        return $this->getKey();
    }

}
