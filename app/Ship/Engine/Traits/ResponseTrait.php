<?php

namespace App\Ship\Engine\Traits;

use Fractal;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Request;
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
     * @param $data
     * @param null $transformerName
     * @param array|null $includes
     * @param array $meta
     * @param null $resourceKey
     *
     * @return array
     */
    public function transform($data, $transformerName = null, array $includes = null, array $meta = [], $resourceKey = null)
    {
        $transformer = new $transformerName;

        // override default includes by the request includes
        if ($requestIncludes = Request::get('include')) {
            $includes = explode(',', $requestIncludes);
        }

        if($includes){
            $includes = array_unique(array_merge($transformer->getDefaultIncludes(), $includes));
            $transformer->setDefaultIncludes($includes);
        }

        // add specific meta information to the response message
        $this->metaData = [
            'include' => $transformer->getAvailableIncludes(),
            'custom' => $meta,
        ];

        // no resource key was set
        if(!$resourceKey) {
            // get the resource key from the model
            $obj = null;
            if($data instanceof AbstractPaginator) {
                $obj = $data->getCollection()->first();
            }
            elseif($data instanceof Collection) {
                $obj = $data->first();
            }
            else {
                $obj = $data;
            }
            $resourceKey = $obj->getResourceKey();
        }

        $fractal = Fractal::create($data, $transformer)->withResourceName($resourceKey)->addMeta($this->metaData);

        // apply request filters if available in the request
        if($requestFilters = Request::get('filter')){
            $result = $this->filterResponse($fractal->toArray(), explode(';', $requestFilters));
        }else{
            $result = $fractal->toArray();
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
    public function json($message, $status = 200, array $headers = [], $options = 0)
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
    public function accepted($message = null, $status = 202, array $headers = [], $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param null $message array or string
     * @param int $status
     * @param array $headers
     * @param int $options
     *
     * @return JsonResponse
     */
    public function created($message = null, $status = 201, array $headers = [], $options = 0)
    {
        return new JsonResponse($message, $status, $headers, $options);
    }

    /**
     * @param $responseArray
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleted($responseArray = null)
    {
        if(!$responseArray){
            return $this->accepted();
        }

        $id = $responseArray->getHashedKey();
        $className = (new ReflectionClass($responseArray))->getShortName();

        return $this->accepted([
            'message' => "$className ($id) Deleted Successfully.",
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
     * @param array $responseArray
     * @param array $filters
     *
     * @return array
     */
    private function filterResponse(array $responseArray, array $filters)
    {
        foreach ($responseArray as $k => $v)
        {
            if(in_array($k, $filters, true)) {
                // we have found our element - so continue with the next one
                continue;
            }

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
