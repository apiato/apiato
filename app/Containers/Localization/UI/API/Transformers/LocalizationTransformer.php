<?php

namespace App\Containers\Localization\UI\API\Transformers;

use App\Containers\Localization\Models\Localization;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class LocalizationTransformer
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
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
            'default_name' => $entity->getDefaultName(),
            'locale_name' => $entity->getLocaleName(),
        ];

        $response = $this->ifAdmin([

        ], $response);

        return $response;
    }
}
