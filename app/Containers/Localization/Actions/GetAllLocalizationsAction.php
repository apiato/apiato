<?php

namespace App\Containers\Localization\Actions;

use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;

/**
 * Class GetAllLocalizationsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllLocalizationsAction extends Action
{

    /**
     * @return  mixed
     */
    public function run()
    {
        $localizations = Apiato::call('Localization@GetAllLocalizationsTask');

        return $localizations;
    }
}
