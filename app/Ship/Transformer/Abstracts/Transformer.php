<?php

namespace App\Ship\Transformer\Abstracts;

use App\Containers\Authentication\Tasks\GetAuthenticatedUserTask;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract as FractalTransformerAbstract;

/**
 * Class Transformer.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Transformer extends FractalTransformerAbstract
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
        if ($this->user()->hasAdminRole()) {
            return array_merge($clientResponse, $adminResponse);
        }

        return $clientResponse;
    }

}
