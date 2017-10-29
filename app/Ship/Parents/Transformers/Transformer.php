<?php

namespace App\Ship\Parents\Transformers;

use Apiato\Core\Abstracts\Transformers\Transformer as AbstractTransformer;
use App\Ship\Exceptions\InternalErrorException;
use App\Ship\Exceptions\UnsupportedFractalIncludeException;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Config;
use League\Fractal\Scope;

/**
 * Class Transformer.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Transformer extends AbstractTransformer
{
    /**
     * @param Scope  $scope
     * @param string $includeName
     * @param mixed  $data
     *
     * @return \League\Fractal\Resource\ResourceInterface
     * @throws InternalErrorException
     * @throws UnsupportedFractalIncludeException
     */
    protected function callIncludeMethod(Scope $scope, $includeName, $data)
    {
        try {
            return parent::callIncludeMethod($scope, $includeName, $data);
        }
        catch (ErrorException $exception) {
            if (Config::get('apiato.requests.force-valid-includes', true)) {
                throw new UnsupportedFractalIncludeException();
            }
        }
        catch (Exception $exception) {
            throw new InternalErrorException();
        }
    }

}
