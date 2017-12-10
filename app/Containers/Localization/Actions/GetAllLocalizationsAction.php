<?php

namespace App\Containers\Localization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

/**
 * Class GetAllLocalizationsAction
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllLocalizationsAction extends Action
{

    /**
     * @return  \Illuminate\Support\Collection
     */
    public function run(): Collection
    {
        $localizations = Apiato::call('Localization@GetAllLocalizationsTask');

        return $localizations;
    }
}
