<?php

namespace App\Containers\Documentation\Traits;

use DateTime;
use Illuminate\Support\Facades\Config;

/**
 * Class DocsGeneratorTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait DocsGeneratorTrait
{

    /**
     * @param $type
     *
     * @return mixed
     */
    private function getFullApiUrl($type)
    {
        return '> ' . $this->getAppUrl() . '/' . $this->getUrl($type);
    }

    /**
     * @return  mixed
     */
    private function getAppUrl()
    {
        return Config::get('app.url');
    }

    /**
     * @return  mixed
     */
    private function getHtmlPath()
    {
        return Config::get("{$this->getConfigFile()}.html_files");
    }

    /**
     * Where to generate the new documentation.
     *
     * @param $type
     *
     * @return string
     */
    private function getDocumentationPath($type)
    {
        return $this->getHtmlPath() . $this->getUrl($type);
    }

    /**
     * @param $type
     *
     * @return string
     */
    private function getJsonFilePath($type)
    {
        return "app/Containers/Documentation/ApiDocJs/{$type}";
    }

    /**
     * @return  string
     */
    private function getConfigFile()
    {
        return 'documentation-container';
    }

    /**
     * @return  mixed
     */
    private function getTypeConfig()
    {
        return Config::get($this->getConfigFile() . '.types');
    }

    /**
     * @return  mixed
     */
    private function getExecutable()
    {
        return Config::get($this->getConfigFile() . '.executable');
    }

    /**
     * @param $type
     *
     * @return  mixed
     */
    private function getUrl($type)
    {
        $configs = $this->getTypeConfig();

        return $configs[$type]['url'];
    }

    /**
     * @param $type
     *
     * @return  string
     */
    private function getEndpointFiles($type)
    {
        $configs = $this->getTypeConfig();

        // what files types needs to be included
        $routeFilesCommand = '';
        $routes = $configs[$type]['routes'];

        foreach ($routes as $route) {
            $routeFilesCommand .= '-f ' . $route . '.php ';
        }

        return $routeFilesCommand;
    }


    /**
     * @param $templateKey
     * @param $value
     */
    private function replace($templateKey, $value)
    {
        $this->headerMarkdownContent = str_replace($templateKey, $value, $this->headerMarkdownContent);
    }

    /**
     * @param $minutes
     *
     * @return  string
     */
    private function minutesToTimeDisplay($minutes)
    {
        $seconds = $minutes * 60;

        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

}
