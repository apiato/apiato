<?php

namespace App\Containers\Localization\ValueObjects;

use App\Ship\Parents\ValueObjects\ValueObject;
use Illuminate\Support\Facades\Config;
use Locale;

/**
 * Class Localization
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Localization extends ValueObject
{

    /**
     * @var  null
     */
    private $language = null;

    /**
     * @var  array
     */
    private $regions = [];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'localizations';

    /**
     * Localization constructor.
     *
     * @param       $language
     * @param array $regions
     */
    public function __construct($language, array $regions = [])
    {
        $this->language = $language;

        foreach ($regions as $region) {
            $this->regions[] = new Region($region);
        }
    }

    /**
     * @return  string
     */
    public function getDefaultName()
    {
        return Locale::getDisplayLanguage($this->language, Config::get('app.locale'));
    }

    /**
     * @return  string
     */
    public function getLocaleName()
    {
        return Locale::getDisplayLanguage($this->language, $this->language);
    }

    /**
     * @return  null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return  array
     */
    public function getRegions()
    {
        return $this->regions;
    }
}
