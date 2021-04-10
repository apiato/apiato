<?php

namespace App\Containers\AppSection\Documentation\Tasks;

use App\Ship\Parents\Tasks\Task;
use DateTime;

class RenderTemplatesTask extends Task
{
    private $headerMarkdownContent;
    private string $templatePath;
    private string $outputPath;
    // ['templateKey', value]
    private array $replaceArray;

    public function __construct()
    {
        $this->templatePath = 'Containers/' . config('documentation-container.section_name') . '/Documentation/ApiDocJs/shared/header.template.md';
        $this->outputPath = 'Containers/' . config('documentation-container.section_name') . '/Documentation/UI/WEB/Views/documentation/header.md';
        $this->replaceArray = [
            'api.domain.test', config('apiato.api.url'),
            '{{rate-limit-expires}}', config('apiato.api.throttle.expires'),
            '{{rate-limit-attempts}}', config('apiato.api.throttle.attempts'),
            '{{access-token-expires-in}}', $this->minutesToTimeDisplay(config('apiato.api.expires-in')),
            '{{access-token-expires-in}}', $this->minutesToTimeDisplay(config('apiato.api.expires-in')),
            '{{access-token-expires-in-minutes}}', config('apiato.api.expires-in'),
            '{{refresh-token-expires-in}}', $this->minutesToTimeDisplay(config('apiato.api.refresh-expires-in')),
            '{{refresh-token-expires-in-minutes}}', config('apiato.api.refresh-expires-in'),
            '{{pagination-limit}}', config('repository.pagination.limit')
        ];
    }

    private function minutesToTimeDisplay($minutes): string
    {
        $seconds = $minutes * 60;

        $dtF = new DateTime('@0');
        $dtT = new DateTime("@$seconds");

        return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
    }

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     */
    public function run(): string
    {
        // read the template file
        $this->headerMarkdownContent = file_get_contents(app_path($this->templatePath));
        $this->headerMarkdownContent = $this->replaceMarkdownContent($this->headerMarkdownContent, $this->replaceArray);

        // this is what the apidoc.json file will point to to load the header.md
        // write the actual file
        $path = app_path($this->outputPath);
        file_put_contents($path, $this->headerMarkdownContent);

        return $path;
    }

    private function replaceMarkdownContent($markdownContent, array $replaceArray)
    {
        foreach ($replaceArray as $key => $value) {
            $markdownContent = $this->replace($markdownContent, $key, $value);
        }

        return $markdownContent;
    }

    private function replace($markdownContent, $templateKey, $value)
    {
        return str_replace($templateKey, $value, $markdownContent);
    }
}
