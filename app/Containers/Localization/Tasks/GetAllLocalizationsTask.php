<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\Data\Repositories\LocalizationRepository;
use App\Containers\Localization\Models\Localization;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class GetAllLocalizationsTask extends Task
{

    public function run()
    {
        $supported_localizations = Config::get('localization-container.supported_languages');

        $localizations = collect();

        foreach ($supported_localizations as $key => $value) {
            $localizations->push(new Localization($key));
        }

        return $localizations;
    }
}
