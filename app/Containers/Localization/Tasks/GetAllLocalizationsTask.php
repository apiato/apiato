<?php

namespace App\Containers\Localization\Tasks;

use App\Containers\Localization\ValueObjects\Localization;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

/**
 * Class GetAllLocalizationsTask
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class GetAllLocalizationsTask extends Task
{

    /**
     * @return  \Illuminate\Support\Collection
     */
    public function run()
    {
        $supported_localizations = Config::get('localization-container.supported_languages');

        $localizations = new Collection();

        foreach ($supported_localizations as $key => $value)
        {
            // it is a simple key
            if (! is_array($value)) {
                $localizations->push(new Localization($value));
            }

            // it is a composite key
            if (is_array($value)) {
                $localizations->push(new Localization($key, $value));
            }
        }

        return $localizations;
    }
}
