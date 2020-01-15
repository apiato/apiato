<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class TestFunctionalTestGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class TestFunctionalTestGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:test:functional';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Functional Test file.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Functional Test';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/UI/{user-interface}/Tests/Functional/*';

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
    protected $stubName = 'tests/functional/general.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['ui', null, InputOption::VALUE_OPTIONAL, 'The user-interface to generate the Test for.'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $ui = Str::lower($this->checkParameterOrChoice('ui', 'Select the UI for the Test', ['API', 'WEB', 'CLI'], 0));

        // set the stub file accordingly
        $this->stubName = 'tests/functional/' . $ui . '.stub';

        // we need to generate the TestCase class before
        $this->call('apiato:generate:test:testcase', [
            '--container' => $this->containerName,
            '--file' => 'TestCase',
            '--ui' => $ui,
        ]);

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
                'user-interface' => Str::upper($ui),
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name'  => $this->containerName,
                'class-name'      => $this->fileName,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    public function getDefaultFileName()
    {
        return 'DefaultFunctionalTest';
    }

}

