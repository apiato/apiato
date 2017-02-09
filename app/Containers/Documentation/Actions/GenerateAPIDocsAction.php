<?php

namespace App\Containers\Documentation\Actions;

use App\Containers\Documentation\Exceptions\WrongDocTypeException;
use App\Containers\Documentation\Tasks\GenerateApiDocJsDocsTask;
use App\Port\Action\Abstracts\Action;

/**
 * Class GenerateAPIDocsAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class GenerateAPIDocsAction extends Action
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
     * @var  \App\Containers\Documentation\Tasks\GenerateApiDocJsDocsTask
     */
    private $generateApiDocJsDocsTask;

    /**
     * GenerateAPIDocsAction constructor.
     *
     * @param \App\Containers\Documentation\Tasks\GenerateApiDocJsDocsTask $generateApiDocJsDocsTask
     */
    public function __construct(GenerateApiDocJsDocsTask $generateApiDocJsDocsTask)
    {
        $this->generateApiDocJsDocsTask = $generateApiDocJsDocsTask;
    }

    /**
     * @param $types
     *
     * @return  string
     */
    public function run($types)
    {
        // generate the full namespace of the types class based on this function param
        if (!class_exists($typeClass = self::TYPES_CLASSES_NAMESPACE . ucwords($types) . self::TYPES_CLASSES_POSTFIX)) {
            throw new WrongDocTypeException("The Documentation type ($typeClass) is not supported!");
        }

        // create an instance of the Documentation Type Class and pass it as argument to this task
        return $this->generateApiDocJsDocsTask->run(new $typeClass());
    }
}
