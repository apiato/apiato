<?php

namespace App\Ship\Engine\Traits;

use App\Ship\Features\Exceptions\IncorrectIdException;
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
                if (!in_array($route->uri(), $this->skippedEndpoints)) {

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
            return $this->encoder(($key) ? : $this->getKey());
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
    private function decodeHashedIdsBeforeApplyingValidationRules(Array $requestData)
    {

        // the hash ID feature must be enabled to use this decoder feature.
        if (Config::get('hello.hash-id') && isset($this->decode) && !empty($this->decode)) {

            foreach ($this->decode as $id) {

                if (isset($requestData[$id])) {
                    // validate the user is not trying to pass real ID
                    if (is_numeric($requestData[$id])) {
                        throw new IncorrectIdException('Only Hashed ID\'s allowed to be passed.');
                    }

                    $requestData[$id] = is_array($requestData[$id]) ?
                        $this->decodeThisArrayOfIds($requestData[$id]) : $this->decodeThisId($requestData[$id]);

                } // do nothing if the input is incorrect, because what if it's not required!
            }
        }

        return $requestData;
    }

    /**
     * @param array $ids
     *
     * @return  array
     */
    public function decodeThisArrayOfIds(array $ids)
    {
        $result = [];
        foreach ($ids as $id) {
            $result[] = $this->decodeThisId($id);
        }

        return $result;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function decodeThisId($id)
    {
        return empty($this->decoder($id)) ? [] : $this->decoder($id)[0];
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
