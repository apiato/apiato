<?php

namespace App\Ship\Parents\Transformers;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract as FractalTransformer;

/**
 * Class Transformer.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Transformer extends FractalTransformer
{

    /**
     * @return  mixed
     */
    public function user()
    {
        return App::make(GetAuthenticatedUserTask::class)->run();
    }

    /**
     * @param $adminResponse
     * @param $clientResponse
     *
     * @return  array
     */
    public function ifAdmin($adminResponse, $clientResponse)
    {
        $user = $this->user();

        if (!is_null($user) && $user->hasAdminRole()) {
            return array_merge($clientResponse, $adminResponse);
        }

        return $clientResponse;
    }

    /**
     * @param mixed $data
     * @param callable|FractalTransformer $transformer
     * @param null $resourceKey
     *
     * @return \League\Fractal\Resource\Item
     */
    public function item($data, $transformer, $resourceKey = null)
    {
        // set a default resource key if none is set
        if(!$resourceKey) {
            $resourceKey = $data->getResourceKey();
        }
        return parent::item($data, $transformer, $resourceKey);
    }

    /**
     * @param mixed $data
     * @param callable|FractalTransformer $transformer
     * @param null $resourceKey
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function collection($data, $transformer, $resourceKey = null)
    {
        // set a default resource key if none is set
        if(!$resourceKey) {
            $obj = $data->first();
            $resourceKey = $obj->getResourceKey();
        }
        return parent::collection($data, $transformer, $resourceKey);
    }

}
