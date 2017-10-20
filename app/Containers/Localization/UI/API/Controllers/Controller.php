<?php

namespace App\Containers\Localization\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Localization\UI\API\Requests\GetAllLocalizationsRequest;
use App\Containers\Localization\UI\API\Transformers\LocalizationTransformer;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{
    /**
     * Get all supported Localizations of the application.
     *
     * @param GetAllLocalizationsRequest $request
     *
     * @return array
     */
    public function getAllLocalizations(GetAllLocalizationsRequest $request)
    {
        $localizations = Apiato::call('Localization@GetAllLocalizationsAction', [$request]);

        return $this->transform($localizations, LocalizationTransformer::class);
    }
}
