<?php

namespace App\Containers\Localization\UI\API\Transformers;

use App\Containers\Localization\Models\Localization;
use App\Ship\Parents\Transformers\Transformer;
use Illuminate\Support\Facades\Config;
use Locale;

class LocalizationTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Localization $entity
     *
     * @return array
     */
    public function transform(Localization $entity)
    {
        $response = [
            'object' => 'Localization',
            'id' => $entity->code,

            'code' => $entity->code,
            'default_name' => Locale::getDisplayLanguage($entity->code, Config::get('app.locale')),
            'locale_name' => Locale::getDisplayLanguage($entity->code, $entity->code),
        ];

        $response = $this->ifAdmin([

        ], $response);

        return $response;
    }
}
