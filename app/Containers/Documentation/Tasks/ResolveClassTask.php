<?php

namespace App\Containers\Documentation\Tasks;

use App\Ship\Parents\Tasks\Task;

/**
 * Class ResolveClassTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ResolveClassTask extends Task
{

    /**
     * string
     */
    const TYPES_CLASSES_NAMESPACE = 'App\Containers\Documentation\Objects\\';

    /**
     * string
     */
    const TYPES_CLASSES_POSTFIX = 'Api';


    /**
     * @param $types
     */
    public function run($types)
    {
        // generate the full namespace of the types class based on this function param
        if (!class_exists($typeClass = self::TYPES_CLASSES_NAMESPACE . ucwords($types) . self::TYPES_CLASSES_POSTFIX)) {
            throw new WrongDocTypeException("The Documentation type ($typeClass) is not supported!");
        }

        return $typeClass;
    }

}
