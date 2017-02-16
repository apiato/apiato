<?php

namespace App\Containers\Documentation\Actions;

use App\Port\Action\Abstracts\Action;
use DateTime;
use Illuminate\Support\Facades\Config;

/**
 * Class ProcessMarkdownTemplatesAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ProcessMarkdownTemplatesAction extends Action
{

    protected $headerMarkdownContent;

    const TEMPLATE_PATH = 'Containers/Documentation/ApiDocJs/shared/';
    const OUTPUT_PATH = 'api-markdowns/';

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

        // write the actual file
        file_put_contents(public_path(self::OUTPUT_PATH . 'header.md'), $this->headerMarkdownContent);
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
