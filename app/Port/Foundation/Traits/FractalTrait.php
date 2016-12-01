<?php

namespace App\Port\Foundation\Traits;

use App;
use App\Port\Exception\Exceptions\UnsupportedFractalSerializerException;
use DB;
use File;
use Illuminate\Support\Facades\Config;
use Log;

/**
 * Class FractalTrait.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
trait FractalTrait
{

    /**
     * By default the Dingo API package (in the config file) creates an instance of the
     * fractal manager which takes the default serializer (specified by the fractal
     * package itself, and there's no way to override change it from the configurations of
     * the Dingo package).
     *
     * Here I am replacing the current default serializer (DataArraySerializer) by the
     * (JsonApiSerializer).
     *
     * "Serializers are what build the final response after taking the transformers data".
     */
    public function overrideDefaultFractalSerializer()
    {
        $serializerName = Config::get('api.serializer');

        // if DataArray `\League\Fractal\Serializer\DataArraySerializer` do noting since it's set by default by the Dingo API
        if ($serializerName !== 'DataArray') {
            app('Dingo\Api\Transformer\Factory')->setAdapter(function () use ($serializerName) {
                switch ($serializerName) {
                    case 'JsonApi':
                        $serializer = new \League\Fractal\Serializer\JsonApiSerializer(Config::get('api.domain'));
                        break;
                    case 'Array':
                        $serializer = new \League\Fractal\Serializer\ArraySerializer(Config::get('api.domain'));
                        break;
                    default:
                        throw new UnsupportedFractalSerializerException('Unsupported ' . $serializerName);
                }

                $fractal = new \League\Fractal\Manager();
                $fractal->setSerializer($serializer);

                return new \Dingo\Api\Transformer\Adapter\Fractal($fractal, 'include', ',', false);
            });
        }
    }

}
