<?php

namespace App\Containers\Localization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use Illuminate\Support\Facades\Config;
use Locale;

class Localization //extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    private $language = null;
    private $regions = [];

    public function __construct($language, array $regions = [])
    {
        $this->language = $language;

        foreach ($regions as $region) {
            $this->regions[] = new Region($region);
        }
    }

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'localizations';

    public function getDefaultName() {
        return Locale::getDisplayLanguage($this->language, Config::get('app.locale'));
    }

    public function getLocaleName() {
        return Locale::getDisplayLanguage($this->language, $this->language);
    }

    public function getLanguage() {
        return $this->language;
    }

    public function getRegions() {
        return $this->regions;
    }
}
