<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Exceptions\NoDocTypesFoundException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class GetAllDocsTypesTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllDocsTypesTask extends Task
{

    /**
     * @return  array
     * @throws \App\Containers\Documentation\Exceptions\NoDocTypesFoundException
     */
    public function run()
    {
        if (!$configTypes = Config::get('documentation-container.types')) {
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
