<?php

namespace App\Containers\AppSection\Documentation\Tasks;

use App\Containers\AppSection\Documentation\Traits\DocsGeneratorTrait;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

class RenderTemplatesTask extends Task
{
    use DocsGeneratorTrait;

    private const TEMPLATE_PATH = 'Containers/AppSection/Documentation/ApiDocJs/shared/header.template.md';
    private const OUTPUT_PATH = 'Containers/AppSection/Documentation/UI/WEB/Views/documentation/header.md';
    protected $headerMarkdownContent;

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     */
    public function run(): string
    {
        // read the template file
        $this->headerMarkdownContent = file_get_contents(app_path(self::TEMPLATE_PATH));

        $this->replace('api.domain.test', Config::get('apiato.api.url'));
        $this->replace('{{rate-limit-expires}}', Config::get('apiato.api.throttle.expires'));
        $this->replace('{{rate-limit-attempts}}', Config::get('apiato.api.throttle.attempts'));
        $this->replace('{{access-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('apiato.api.expires-in')));
        $this->replace('{{access-token-expires-in-minutes}}', Config::get('apiato.api.expires-in'));
        $this->replace('{{refresh-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('apiato.api.refresh-expires-in')));
        $this->replace('{{refresh-token-expires-in-minutes}}', Config::get('apiato.api.refresh-expires-in'));
        $this->replace('{{pagination-limit}}', Config::get('repository.pagination.limit'));

        // this is what the apidoc.json file will point to to load the header.md
        // write the actual file
        $path = app_path(self::OUTPUT_PATH);
        file_put_contents($path, $this->headerMarkdownContent);

        return $path;
    }
}
