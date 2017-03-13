<?php

namespace App\Ship\Features\Validations;

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
        Validator::extend('no_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        }, ['String should not contain space.']);
    }
}
