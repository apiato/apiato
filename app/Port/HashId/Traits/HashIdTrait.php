<?php

namespace App\Port\HashId\Traits;

use App\Port\Exception\Exceptions\IncorrectIdException;
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
     * endpoint to be skipped from decoding their ID's (example for external ID's)
     * @var  array
     */
    private $skippedEndpoints = [
//        'orders/{id}/external',
    ];

    /**
     * All ID's passed with all endpoints will be decoded before entering the Application
     */
    public function runEndpointsHashedIdsDecoder()
    {
        if (Config::get('hello.hash-id')) {
            Route::bind('id', function ($id, $route) {
                // skip decoding some endpoints
                if (!in_array($route->getUri(), $this->skippedEndpoints)) {

                    // decode the ID in the URL
                    $decoded = Hashids::decode($id);

                    if (empty($decoded)) {
                        throw new IncorrectIdException('ID (' . $id . ') is incorrect, consider using the hashed ID 
                        instead of the numeric ID.');
                    }

                    return $decoded[0];
                }
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
