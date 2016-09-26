<?php

namespace App\Containers\Countries\UI\API\Transformers;

use App\Containers\Countries\Models\Country;
use App\Port\Transformer\Abstracts\Transformer;

/**
 * Class CurrencyTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CurrencyTransformer extends Transformer
{

    /**
     * @param \App\Containers\Countries\UI\API\Transformers\Country $country
     *
     * @return  array
     */
    public function transform(Country $country)
    {
        return [
            'type'         => 'currency',
            'id'           => (int)$country->id,
            'name'         => $country->currency,
            'code'         => $country->currency_code,
            'symbol'       => $country->currency_symbol,
            'sub_unit'     => $country->currency_sub_unit,
            'country_name' => $country->name,
        ];
    }
}
