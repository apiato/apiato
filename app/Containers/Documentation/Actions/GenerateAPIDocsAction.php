<?php

namespace App\Containers\Documentation\Actions;

use App\Containers\Documentation\Tasks\GenerateApiDocJsDocsTask;
use App\Containers\Documentation\Tasks\ResolveClassTask;
use App\Ship\Parents\Actions\Action;

/**
 * Class GenerateAPIDocsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateAPIDocsAction extends Action
{

    /**
     * @param $types
     *
     * @return  string
     */
    public function run($types)
    {
        // generate the full namespace of the types class based on this function param
        $typeClass = $this->call(ResolveClassTask::class, [$types]);

        // create an instance of the Documentation Type Class and pass it as argument to this task
        return $this->call(GenerateApiDocJsDocsTask::class, [new $typeClass()]);
    }
}
