<?php

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Apiato\Core\Foundation\Facades\Apiato;

class GetAllLocalizationsAction extends Action
{
    public function run(Request $request)
    {
        $localizations = Apiato::call('Localization@GetAllLocalizationsTask');

        return $localizations;
    }
}
