<?php

namespace App\Containers\Documentation\Objects;

use App\Containers\Documentation\Contracts\ApiTypeInterface;

/**
 * Class PrivateApi.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class PrivateApi implements ApiTypeInterface
{

    CONST TYPE = 'private';

    /**
     * @var  string
     */
    protected $url = 'api/private/documentation';

    /**
     * Where to generate the new documentation.
     *
     * @return  string
     */
    public function getDocumentationPath()
    {
        return 'public/' . $this->url;
    }

    /**
     * @return  string
     */
    public function getJsonFilePath()
    {
        return "app/Containers/Documentation/ApiDocJs/{$this->getType()}";
    }

    /**
     * @return  string
     */
    public function getType()
    {
        return self::TYPE;
    }

    /**
     * @return  string
     */
    public function getUrl()
    {
        return $this->url;
    }

}
