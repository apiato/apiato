<?php

namespace App\Ship\Engine\Traits;

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

        if (!empty($requestIncludes = Request::get('include', null))) {
            $transformer->setDefaultIncludes(explode(',', $requestIncludes));
        }

        return Fractal::create($data, $transformer)->addMeta($this->metaData)->toJson();
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

}
