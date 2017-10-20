<?php

namespace App\Containers\Localization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Ship\Parents\Models\Model;

class Localization //extends Model
{
    use HashIdTrait;
    use HasResourceKeyTrait;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'localizations';
}
