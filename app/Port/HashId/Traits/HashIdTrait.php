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
                    $decoded = $this->decoder($id);

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
     * @param $id
     *
     * @return  mixed
     */
    public function decodeThisId($id)
    {
        if (Config::get('hello.hash-id')) {
            return empty($this->decoder($id)) ? [] : $this->decoder($id)[0];
        }

        return $id;
    }

  /**
   * Will be used by the Eloquent Models (since it's used as trait there).
   *
   * @param null $key
   *
   * @return  mixed
   */
    public function getHashedKey($key = null)
    {
        // hash the ID only if hash-id enabled in the config
        if (Config::get('hello.hash-id')) {
            return $this->encoder(($key) ?: $this->getKey());
        }

        return $this->getKey();
    }


    /**
     * without decoding the encoded ID's you won't be able to use
     * validation features like `exists:table,id`
     *
     * @param array $requestData
     *
     * @return  array
     */
    private function decodeHashedIdsBeforeValidatingThem(Array $requestData)
    {
        foreach ($this->decode as $id) {

            if (isset($requestData[$id])) {
                // validate the user is not trying to pass real ID
                if (is_numeric($requestData[$id])) {
                    throw new IncorrectIdException('Only Hashed ID\'s allowed to be passed.');
                }

                // perform the decoding
                $requestData[$id] = $this->decodeThisId($requestData[$id]);
            } // do nothing if the input is incorrect, because what if it's not required!
        }

        return $requestData;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    private function decoder($id)
    {
        return Hashids::decode($id);
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    private function encoder($id)
    {
        return Hashids::encode($id);
    }

}
