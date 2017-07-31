<?php

namespace App\Ship\Generator\Commands;

use App\Ship\Generator\GeneratorCommand;
use App\Ship\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ModelGenerator
 *
 * @author  Justin Atack  <justinatack@gmail.com>
 */
class ModelGenerator extends GeneratorCommand implements ComponentsGenerator
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Model';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Models/*';

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
    protected $stubName = 'model.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['repository', null, InputOption::VALUE_OPTIONAL, 'Generate the corresponding Repository for this Model?'],
    ];

    /**
     * urn mixed|void
     */
    public function getUserInputs()
    {
        $repository = $this->checkParameterOrConfirm('repository', 'Do you want to generate the corresponding Repository for this Model?', true);
        if($repository) {
            // we need to generate a corresponding repository
            // so call the other command
            $status = Artisan::call('apiato:repository', [
                                    '--container' => $this->containerName,
                                    '--file' => $this->fileName . 'Repository'
            ]);

            if($status == 0) {
                $this->printInfoMessage('The Repository was successfully generated');
            }
            else {
                $this->printErrorMessage('Could not generate the corresponding Repository!');
            }
        }

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }
}
