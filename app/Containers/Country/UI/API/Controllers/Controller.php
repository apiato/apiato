<?php

namespace App\Containers\Country\UI\API\Controllers;

use App\Containers\Country\UI\API\Transformers\CountryTransformer;
use App\Containers\Country\Actions\ListAllCountriesAction;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Controller extends ApiController
{
    /**
     * @param \App\Containers\Country\Actions\ListAllCountriesAction $action
     *
     * @return \Dingo\Api\Http\Response
     */
    public function listAllCountries(ListAllCountriesAction $action)
    {
        $countries = $action->run();

        return $this->response->collection($countries, new CountryTransformer(), 'country');
    }
}
