<?php

namespace App\Containers\Country\UI\API\Transformers;

use App\Containers\Country\Models\Country;
use App\Port\Transformer\Abstracts\Transformer;

/**
 * Class CountryTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CountryTransformer extends Transformer
{

    /**
     * @param \App\Containers\Country\UI\API\Transformers\Country $country
     *
     * @return  array
     */
    public function transform(Country $country)
    {
        return [
            'type'            => 'country',
            'id'              => (int)$country->id,
            'name'            => $country->name,
            'full_name'       => $country->full_name,
            'iso_3166_2'      => $country->iso_3166_2,
//            'currency'        => $country->currency,
//            'currency_code'   => $country->currency_code,
//            'currency_symbol' => $country->currency_symbol,
            'country_flag'    => asset('assets/flags/' . $country->flag),
        ];
    }
}
