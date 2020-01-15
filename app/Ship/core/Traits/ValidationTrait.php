<?php

namespace Apiato\Core\Traits;

use Validator;

/**
 * Class ValidationTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait ValidationTrait
{

    /**
     * Extend the default Laravel validation rules.
     */
    public function extendValidationRules()
    {
        // Validate String contains no space.
        Validator::extend('no_spaces', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\S*$/u', $value);
        }, ['String should not contain space.']);

        // Validate composite unique ID.
        // Usage: unique_composite:table,this-attribute-column,the-other-attribute-column
        // Example:    'values'               => 'required|unique_composite:item_variant_values,value,item_variant_name_id',
        //             'item_variant_name_id' => 'required',
        Validator::extend('unique_composite', function ($attribute, $value, $parameters, $validator) {

            $queryBuilder = \DB::table($parameters[0]);

            $queryBuilder = is_array($value) ? $queryBuilder->whereIn($parameters[1],
                $value) : $queryBuilder->where($parameters[1], $value);

            $queryBuilder->where($parameters[2], $validator->getData()[$parameters[2]]);

            $queryResult = $queryBuilder->get();

            return $queryResult->isEmpty();
        }, ["Duplicated record. This record has composite ID and it must be unique."]);
    }

}
