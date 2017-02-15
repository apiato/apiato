<?php

namespace App\Containers\Documentation\Objects;

use App\Containers\Documentation\Abstracts\ApiTypeAbstract;
use App\Containers\Documentation\Contracts\ApiTypeInterface;

/**
 * Class PublicApi.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PublicApi extends ApiTypeAbstract implements ApiTypeInterface
{

    public static $type = 'public';

    private $routeFiles = '-f public.php';

    public function getCommand()
    {
        return "-c {$this->getJsonFilePath()}   {$this->routeFiles}   -i app   -o {$this->getDocumentationPath()}";
    }

}
