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

        $this->replace('api.domain.dev', Config::get('api.domain'));
        $this->replace('{{rate-limit-expires}}', Config::get('hello.api.limit_expires'));
        $this->replace('{{rate-limit}}', Config::get('hello.api.limit'));
        $this->replace('{{token-expires}}', $this->minutesToTimeDisplay(Config::get('jwt.ttl')));
        $this->replace('{{token-expires-minutes}}', Config::get('jwt.ttl'));
        $this->replace('{{pagination-limit}}', Config::get('repository.pagination.limit'));

        // this is what the apidoc.json file will point to to load the header.md
        // example: "filename": "../public/api-rendered-markdowns/header.md"
        $path = public_path(self::OUTPUT_PATH . 'header.md');

        // write the actual file
        file_put_contents($path, $this->headerMarkdownContent);

        return $path;
    }

}
