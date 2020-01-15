<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MailGenerator
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class MailGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Mail class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Mail';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Mails/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{file-name}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'mail.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['view', null, InputOption::VALUE_OPTIONAL, 'The name of the view (blade template) to be loaded.'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $view = $this->checkParameterOrAsk('view', 'Enter the name of the view to be loaded when sending this Mail');

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name'  => $this->containerName,
                'class-name'      => $this->fileName,
                'view'            => $view,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'DefaultMail';
    }

}

