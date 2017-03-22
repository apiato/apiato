<?php

namespace App\Containers\Documentation\Abstracts;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\App;

/**
 * Class ApiTypeAbstract.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class ApiTypeAbstract
{

    const CONFIG_FILE = 'apidoc';

    /**
     * @var string
     */
    public $url;

    /**
     * ApiTypeAbstract constructor.
     */
    public function __construct()
    {
        $this->config = App::make(Repository::class);
    }

    /**
     * @return  string
     */
    public function getType()
    {
        return static::$type;
    }

    /**
     * @return  string
     */
    public function getUrl()
    {
        return $this->config->get("{$this->getConfigFile()}.types.{$this->getType()}.url");
    }

    /**
     * @return  mixed
     */
    public function getHtmlPath()
    {
        return $this->config->get("{$this->getConfigFile()}.html_files");
    }

    /**
     * Where to generate the new documentation.
     *
     * @return  string
     */
    public function getDocumentationPath()
    {
        return $this->getHtmlPath() . $this->getUrl();
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
    private function getConfigFile()
    {
        return self::CONFIG_FILE;
    }

}
