<?php

namespace App\Containers\Documentation\Traits;

use DateTime;
use Illuminate\Support\Facades\Config;

trait DocsGeneratorTrait
{
    private function getFullApiUrl($type): string
    {
        return '> ' . $this->getAppUrl() . '/' . $this->getUrl($type);
    }

    private function getAppUrl()
    {
        return Config::get('app.url');
    }

    private function getUrl($type)
    {
        $configs = $this->getTypeConfig();

        return $configs[$type]['url'];
    }

    private function getTypeConfig()
    {
        return Config::get($this->getConfigFile() . '.types');
    }

    private function getConfigFile(): string
    {
        return 'documentation-container';
    }

    private function getDocumentationPath($type): string
    {
        return $this->getHtmlPath() . $this->getUrl($type);
    }

    private function getHtmlPath()
    {
        return Config::get("{$this->getConfigFile()}.html_files");
    }

    private function getJsonFilePath($type): string
    {
        return "app/Containers/Documentation/ApiDocJs/{$type}";
    }

    private function getExecutable()
    {
        return Config::get($this->getConfigFile() . '.executable');
    }

    private function getSwaggerConverter()
    {
        return Config::get($this->getConfigFile() . '.swagger-converter');
    }

    private function getEndpointFiles($type): array
    {
        $configs = $this->getTypeConfig();

        // what files types needs to be included
        $routeFilesCommand = [];
        $routes = $configs[$type]['routes'];

        foreach ($routes as $route) {
            $routeFilesCommand[] = '-f';
            $routeFilesCommand[] = $route . '.php';
        }

        return $routeFilesCommand;
    }

    private function replace($templateKey, $value): void
    {
        $this->headerMarkdownContent = str_replace($templateKey, $value, $this->headerMarkdownContent);
    }

    private function minutesToTimeDisplay($minutes): string
    {
        $seconds = $minutes * 60;

        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }
}
