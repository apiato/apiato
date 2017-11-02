<?php

namespace App\Containers\Localization\ValueObjects;

use App\Ship\Parents\ValueObjects\ValueObject;
use Illuminate\Support\Facades\Config;
use Locale;

/**
 * Class Region
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Region extends ValueObject
{

    /**
     * @var  null
     */
    private $region = null;

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'regions';

    /**
     * Region constructor.
     *
     * @param $region
     */
    public function __construct($region)
    {
        $this->region = $region;
    }

    /**
     * @return  string
     */
    public function getDefaultName()
    {
        return Locale::getDisplayRegion($this->region, Config::get('app.locale'));
    }

    /**
     * @return  string
     */
    public function getLocaleName()
    {
        return Locale::getDisplayRegion($this->region, $this->region);
    }

    /**
     * @return  null
     */
    public function getRegion()
    {
        return $this->region;
    }
}
