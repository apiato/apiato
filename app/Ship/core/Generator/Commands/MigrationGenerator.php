<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MigrationGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class MigrationGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an "empty" migration file for a Container';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Migration';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/Data/Migrations/*';

    /**
     * The structure of the file name.
     *
     * @var  string
     */
    protected $nameStructure = '{date}_{file-name}';

    /**
     * The name of the stub file.
     *
     * @var  string
     */
    protected $stubName = 'migration.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['tablename', null, InputOption::VALUE_OPTIONAL, 'The name for the database table'],
    ];

    /**
     * @return array|null
     */
    public function getUserInputs()
    {
        $tablename = Str::lower($this->checkParameterOrAsk('tablename', 'Enter the name of the database table'));

        // now we need to check, if there already exists a "default migration file" for this container!
        // we therefore search for a file that is named "xxxx_xx_xx_xxxxxx_NAME"
        $exists = false;

        $folder = $this->parsePathStructure($this->pathStructure, ['container-name' => $this->containerName]);
        $folder = $this->getFilePath($folder);
        $folder = rtrim($folder, $this->parsedFileName . '.' . $this->getDefaultFileExtension());

        $migrationname = $this->fileName . '.' . $this->getDefaultFileExtension();

        // get the content of this folder
        $files = File::allFiles($folder);
        foreach ($files as $file) {
            if (Str::endsWith($file->getFilename(), $migrationname)) {
                $exists = true;
            }
        }

        if ($exists) {
            // there exists a basic migration file for this container
            return null;
        }

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name' => $this->containerName,
                'class-name' => Str::studly($this->fileName),
                'table-name' => $tablename
            ],
            'file-parameters' => [
                'date' => Carbon::now()->format('Y_m_d_His'),
                'file-name' => $this->fileName,
            ],
        ];
    }

    /**
     * Get the default file name for this component to be generated
     *
     * @return string
     */
    public function getDefaultFileName()
    {
        return 'create_' . Str::lower($this->containerName) . '_tables';
    }

    /**
     * Removes "special characters" from a string
     *
     * @param $str
     *
     * @return string
     */
    protected function removeSpecialChars($str)
    {
        return $str;
    }
}
