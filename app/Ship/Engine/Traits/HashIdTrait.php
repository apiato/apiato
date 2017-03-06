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
    public function runHashedIdsDecoder()
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
    protected function decodeHashedIdsBeforeValidation(Array $requestData)
    {
        // the hash ID feature must be enabled to use this decoder feature.
        if (Config::get('hello.hash-id') && isset($this->decode) && !empty($this->decode)) {
            // iterate over each key (ID that needs to be decoded) and call keys locator to decode them
            foreach ($this->decode as $key) {
                $requestData = $this->locateAndDecodeIds($requestData, $key);
            }
        }

        return $requestData;
    }

    /**
     * Expected Keys formats:
     *
     * Type 1:
     *   A
     * Type 2:
     *   A.*.B
     *   A.*.B.*.C
     * Type 3:
     *   A.*
     *   A.*.B.*
     *
     * @param $requestData
     * @param $key
     *
     * @return  mixed
     */
    private function locateAndDecodeIds($requestData, $key)
    {
        if ($this->stringEndsWithChars('.*', $key)) {
            // if the key of Type 3:
            $this->decodeType3Key($requestData, $key);
        } elseif (str_contains($key, '.*.')) {
            // if the key of Type 2:
            $this->decodeType2Key($requestData, $key);
        } else {
            // if the key of Type 1:
            $this->decodeType1Key($requestData, $key);
        }

        return $requestData;
    }

    /**
     * @param $requestData
     * @param $key
     */
    private function decodeType1Key(&$requestData, $key)
    {
        // decode single key
        if (isset($requestData[$key])) {
            $requestData[$key] = $this->decode($requestData[$key], $key);
        }
    }

    /**
     * @param $requestData
     * @param $key
     */
    private function decodeType2Key(&$requestData, $key)
    {
        // get the last part of the key, which should be the ID that needs decoding
        $idToDecode = substr($key, strrpos($key, '.*.') + 3);

        array_walk_recursive($requestData, function (&$value, $key) use ($idToDecode) {

            if ($key == $idToDecode) {
                $value = $this->decode($value, $key);
            }

        });
    }

    /**
     * @param $requestData
     * @param $key
     */
    private function decodeType3Key(&$requestData, $key)
    {
        $idToDecode = $this->removeLastOccurrenceFromString($key, '.*');

        $this->findKeyAndReturnValue($requestData, $idToDecode, function ($ids) use ($key){

            if (!is_array($ids)) {
                throw new IncorrectIdException('Expected ID\'s to be in array. Please wrap your ID\'s in an Array and send them back.');
            }

            $decodedIds = [];

            foreach ($ids as $id) {
                $decodedIds[] = $this->decode($id, $key);
            }

            // callback return
            return $decodedIds;
        });
    }

    /**
     * @param $subject
     * @param $findKey
     * @param $callback
     *
     * @return  array
     */
    public function findKeyAndReturnValue(&$subject, $findKey, $callback)
    {
        // if the value is not an array, then you have reached the deepest point of the branch, so return the value.
        if (!is_array($subject)) {
            return $subject;
        }

        foreach ($subject as $key => $value) {

            if ($key == $findKey && isset($subject[$findKey])) {
                $subject[$key] = $callback($subject[$findKey]);
                break;
            }

            // add the value with the recursive call
            $this->findKeyAndReturnValue($value, $findKey, $callback);
        }
    }

    /**
     * @param $search
     * @param $subject
     *
     * @return  mixed
     */
    private function removeLastOccurrenceFromString($subject, $search)
    {
        $replace = '';

        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    /**
     * @param $needle
     * @param $haystack
     *
     * @return  int
     */
    private function stringEndsWithChars($needle, $haystack)
    {
        return preg_match('/' . preg_quote($needle, '/') . '$/', $haystack);
    }

    /**
     * @param array $ids
     *
     * @return  array
     */
    public function decodeArray(array $ids)
    {
        $result = [];
        foreach ($ids as $id) {
            $result[] = $this->decode($id);
        }

        return $result;
    }

    /**
     * @param      $id
     * @param null $parameter
     *
     * @return  array
     */
    public function decode($id, $parameter = null)
    {
        if (is_numeric($id)) {
            throw new IncorrectIdException('Only Hashed ID\'s allowed' . (!is_null($parameter) ? " ($parameter)." : '.'));
        }

        return empty($this->decoder($id)) ? [] : $this->decoder($id)[0];
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function encode($id)
    {
        return $this->encoder($id);
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
    public function encoder($id)
    {
        return Hashids::encode($id);
    }

}
