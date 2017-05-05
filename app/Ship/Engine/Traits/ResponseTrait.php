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

        if($includes){
            $transformer->setDefaultIncludes($includes);
        }

        // get the request
        $request = request();

        // check if the user requested a filter
        $filterparam = $request->query->get('filter');
        if($filterparam != null) {
            // remove all includes from this transformer
            $transformer->setDefaultIncludes([]);
        }

        // process the data
        $raw = Fractal::create($data, $transformer);
        $raw = $raw->addMeta($this->metaData)->toArray();

        if($filterparam == null) {
            // no filters are set..
            // just output the data (with possible includes) and we are fine..
            return $raw;
        }

        // otherwise - we need to sanitize the data
        // process the filters
        $this->filters = explode(';', $filterparam);

        // now manipulate the data..
        $result = $this->processTransformerKey($raw);
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
     * @param $object
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function deleted($object = null)
    {
        if(!$object){
            return $this->accepted();
        }

        $id = $object->getHashedKey();
        $objectType = (new ReflectionClass($object))->getShortName();

        return $this->accepted([
            'message' => "$objectType ($id) Deleted Successfully.",
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
     * Traverse an array and process its nodes
     *
     * @param $obj
     * @return mixed
     */
    private function processTransformerKey(&$obj)
    {
        foreach ($obj as $k => $v)
        {
            if (is_array($v))
            {
                // it is an array - so go one step deeper
                $v = $this->processTransformerKey($v);
                if(empty($v))
                {
                    // it is an empty array - delete the key as well
                    unset($obj[$k]);
                }
                else
                {
                    $obj[$k] = $v;
                }
                continue;
            }
            else
            {
                // check if the array is not in our filter-list
                if(! in_array($k, $this->filters)) {
                    unset($obj[$k]);
                    continue;
                }
            }
        }
        return $obj;
    }

}
