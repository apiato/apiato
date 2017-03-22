<?php

namespace App\Containers\Documentation\Actions;

use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Config;

/**
 * Class GetDocsTypesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetDocsTypesAction extends Action
{

    /**
     * @param $types
     *
     * @return  string
     */
    public function run()
    {
        if (!$configTypes = Config::get('apidoc.types')) {
            throw new NoDocTypesFoundException();
        }

        $types = [];
        foreach ($configTypes as $key => $value) {
            $types[] = $key;
        }

        // NOTE: type names must be the same as in the objects property (`public static $type = 'private';`)
        return $types;
    }
}
