<?php

namespace App\Ship\Engine\Traits;

use Request;
use Fractal;
use Illuminate\Http\JsonResponse;
use ReflectionClass;

/**
 * Class ResponseTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait ResponseTrait
{

    /**
     * @var  array
     */
    protected $metaData = [];

    /**
     * @param            $data
     * @param null       $transformerName
     * @param array|null $includes
     *
     * @return  mixed
     */
    public function transform($data, $transformerName = null, array $includes = null)
    {
        $transformer = new $transformerName;

        // override default includes by the request includes
        if ($requestIncludes = Request::get('include')) {
            $includes = explode(',', $requestIncludes);
        }

        if($includes){
            $transformer->setDefaultIncludes($includes);
        }

        $fractal = Fractal::create($data, $transformer)->addMeta($this->metaData);

        // apply request filters if available in the request
        if($requestFilters = Request::get('filter')){
            $result = $this->filterResponse($fractal->toArray(), explode(';', $requestFilters));
        }else{
            $result = $fractal->toJson();
        }

        return $result;
    }


    /**
     * @param $data
     *
     * @return  $this
     */
    public function withMeta($data)
    {
        $this->metaData = $data;

        return $this;
    }

    /**
     * @param       $message
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function json($message, $status = 200, array $headers = array(), $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param null  array or string $message
     * @param int   $status
     * @param array $headers
     * @param int   $options
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function accepted($message = null, $status = 202, array $headers = array(), $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param $responseArrayect
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleted($responseArrayect = null)
    {
        if(!$responseArrayect){
            return $this->accepted();
        }

        $id = $responseArrayect->getHashedKey();
        $responseArrayectType = (new ReflectionClass($responseArrayect))->getShortName();

        return $this->accepted([
            'message' => "$responseArrayectType ($id) Deleted Successfully.",
        ]);
    }

    /**
     * @param int $status
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function noContent($status = 204)
    {
        return new JsonResponse(null, $status);
    }


    /**
     * @param $responseArray
     * @param $filters
     *
     * @return  mixed
     */
    private function filterResponse($responseArray, $filters)
    {
        foreach ($responseArray as $k => $v)
        {
            if (is_array($v))
            {
                // it is an array - so go one step deeper
                $v = $this->filterResponse($v, $filters);
                if(empty($v))
                {
                    // it is an empty array - delete the key as well
                    unset($responseArray[$k]);
                }
                else
                {
                    $responseArray[$k] = $v;
                }
                continue;
            }
            else
            {
                // check if the array is not in our filter-list
                if(! in_array($k, $filters)) {
                    unset($responseArray[$k]);
                    continue;
                }
            }
        }
        return $responseArray;
    }

}
