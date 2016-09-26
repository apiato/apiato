<?php

namespace App\Containers\Countries\UI\API\Controllers;

use App\Containers\Countries\UI\API\Transformers\CountryTransformer;

use App\Containers\Countries\Actions\ListAllCountriesAction;
use App\Port\Controller\Abstracts\PortApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends PortApiController
{

    /**
     * @param \App\Containers\Countries\Actions\ListAllCountriesAction $action
     *
     * @return  \Dingo\Api\Http\Response
     */
    public function listAllCountries(ListAllCountriesAction $action)
    {
        $countries = $action->run();

        return $this->response->collection($countries, new CountryTransformer());
    }
}
