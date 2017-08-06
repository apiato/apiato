<?php

namespace App\Containers\Documentation\Tasks;

use App\Containers\Documentation\Traits\DocsGeneratorTrait;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Config;

/**
 * Class RenderTemplatesTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RenderTemplatesTask extends Task
{

    use DocsGeneratorTrait;

    protected $headerMarkdownContent;

    const TEMPLATE_PATH = 'Containers/Documentation/ApiDocJs/shared/';
    const OUTPUT_PATH = 'api-rendered-markdowns/';

    /**
     * Read the markdown header template and fill it with some real data from the .env file.
     */
    public function run()
    {
        // read the template file
        $this->headerMarkdownContent = file_get_contents(app_path(self::TEMPLATE_PATH . 'header.template.md'));

        $this->replace('api.domain.dev', Config::get('apiato.api.url'));
        $this->replace('{{rate-limit-expires}}', Config::get('apiato.api.throttle.expires'));
        $this->replace('{{rate-limit-attempts}}', Config::get('apiato.api.throttle.attempts'));
        $this->replace('{{access-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('apiato.api.expires-in')));
        $this->replace('{{access-token-expires-in-minutes}}', Config::get('apiato.api.expires-in'));
        $this->replace('{{refresh-token-expires-in}}', $this->minutesToTimeDisplay(Config::get('apiato.api.refresh-expires-in')));
        $this->replace('{{refresh-token-expires-in-minutes}}', Config::get('apiato.api.refresh-expires-in'));
        $this->replace('{{pagination-limit}}', Config::get('repository.pagination.limit'));

        // this is what the apidoc.json file will point to to load the header.md
        // example: "filename": "../public/api-rendered-markdowns/header.md"
        $path = public_path(self::OUTPUT_PATH . 'header.md');

        // write the actual file
        file_put_contents($path, $this->headerMarkdownContent);

        return $path;
    }

}
