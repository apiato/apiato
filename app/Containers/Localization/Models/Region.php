<?php

namespace App\Containers\Localization\Models;

use Illuminate\Support\Facades\Config;
use Locale;

class Region //extends Model
{
    private $region = null;

    public function __construct($region)
    {
        $this->region = $region;
    }

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'regions';

    public function getDefaultName() {
        return Locale::getDisplayRegion($this->region, Config::get('app.locale'));
    }

    public function getLocaleName() {
        return Locale::getDisplayRegion($this->region, $this->region);
    }

    public function getRegion() {
        return $this->region;
    }
}
