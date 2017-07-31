<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Exceptions\NoDocTypesFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class GetDocsTypesTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetDocsTypesTask extends Task
{

    /**
     * @return  array
     * @throws \App\Containers\Documentation\Exceptions\NoDocTypesFoundException
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
