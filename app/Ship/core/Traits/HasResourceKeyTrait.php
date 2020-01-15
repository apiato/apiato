<?php

namespace Apiato\Core\Traits;

use Illuminate\Support\Pluralizer;
use ReflectionClass;

/**
 * Class HasResourceKeyTrait
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
trait HasResourceKeyTrait
{

    /**
     * Returns the type for JSON API Serializer. Can be overwritten with the protected $resourceKey in respective model class
     *
     * @return string
     */
    public function getResourceKey()
    {
        if (isset($this->resourceKey)) {
            $resourceKey = $this->resourceKey;
        } else {
            $reflect = new ReflectionClass($this);
            $resourceKey = strtolower(Pluralizer::plural($reflect->getShortName()));
        }

        return $resourceKey;
    }
}
