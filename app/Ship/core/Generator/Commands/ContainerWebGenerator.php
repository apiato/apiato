<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ContainerWebGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class ContainerWebGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:container:web';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Container for apiato from scratch (WEB Part)';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Container';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/*';

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
    protected $stubName = 'composer.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['url', null, InputOption::VALUE_OPTIONAL, 'The base URI of all endpoints (/stores, /cars, ...)'],
        ['transporters', null, InputOption::VALUE_OPTIONAL, 'Use specific Transporters or rely on the generic DataTransporter'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $ui = 'web';

        $useTransporters = $this->checkParameterOrConfirm('transporters', 'Would you like to use specific Transporters?', true);

        // containername as inputted and lower
        $containerName = $this->containerName;
        $_containerName = Str::lower($this->containerName);

        // name of the model (singular and plural)
        $model = $this->containerName;
        $models = Pluralizer::plural($model);

        // add the README file
        $this->printInfoMessage('Generating README File');
        $this->call('apiato:generate:readme', [
            '--container'   => $containerName,
            '--file'        => 'README',
        ]);

        // create the configuration file
        $this->printInfoMessage('Generating Configuration File');
        $this->call('apiato:generate:configuration', [
            '--container'   => $containerName,
            '--file'        => $_containerName,
        ]);

        // create the MainServiceProvider for the container
        $this->printInfoMessage('Generating MainServiceProvider');
        $this->call('apiato:generate:serviceprovider', [
            '--container'   => $containerName,
            '--file'        => 'MainServiceProvider',
            '--stub'        => 'mainserviceprovider',
        ]);

        // create the model and repository for this container
        $this->printInfoMessage('Generating Model and Repository');
        $this->call('apiato:generate:model', [
            '--container'   => $containerName,
            '--file'        => $model,
            '--repository'  => true,
        ]);

        // create the migration file for the model
        $this->printInfoMessage('Generating a basic Migration file');
        $this->call('apiato:generate:migration', [
            '--container'   => $containerName,
            '--file'        => 'create_' . Str::lower($_containerName) . '_tables',
            '--tablename'   => $models,
        ]);

        // create the default routes for this container
        $this->printInfoMessage('Generating Default Routes');
        $version = 1;
        $doctype = 'private';

        // get the URI and remove the first trailing slash
        $url = Str::lower($this->checkParameterOrAsk('url', 'Enter the base URI for *all* WEB endpoints (foo/bar)', Str::lower($models)));
        $url = ltrim($url, '/');

        $this->printInfoMessage('Creating Requests for Routes');
        $this->printInfoMessage('Generating Default Actions');
        $this->printInfoMessage('Generating Default Tasks');

        $routes = [
            [
                'stub'        => 'GetAll',
                'name'        => 'GetAll' . $models,
                'operation'   => 'index',
                'verb'        => 'GET',
                'url'         => $url,
                'action'      => 'GetAll' . $models . 'Action',
                'request'     => 'GetAll' . $models . 'Request',
                'task'        => 'GetAll' . $models . 'Task',
                'transporter' => 'GetAll' . $models . 'Transporter',
            ],
            [
                'stub'        => 'Find',
                'name'        => 'Find' . $model . 'ById',
                'operation'   => 'show',
                'verb'        => 'GET',
                'url'         => $url . '/{id}',
                'action'      => 'Find' . $model . 'ById' . 'Action',
                'request'     => 'Find' . $model . 'ById' . 'Request',
                'task'        => 'Find' . $model . 'ById' . 'Task',
                'transporter' => 'Find' . $model . 'ById' . 'Transporter',
            ],
            [
                'stub'        => null,
                'name'        => 'Create' . $model,
                'operation'   => 'create',
                'verb'        => 'GET',
                'url'         => $url . '/create',
                'action'      => null,
                'request'     => 'Create' . $model . 'Request',
                'task'        => null,
                'transporter' => null,
            ],
            [
                'stub'        => 'Create',
                'name'        => 'Store' . $model,
                'operation'   => 'store',
                'verb'        => 'POST',
                'url'         => $url . '/store',
                'action'      => 'Create' . $model . 'Action',
                'request'     => 'Store' . $model . 'Request',
                'task'        => 'Create' . $model . 'Task',
                'transporter' => 'Create' . $model . 'Transporter'
            ],
            [
                'stub'        => null,
                'name'        => 'Edit' . $model,
                'operation'   => 'edit',
                'verb'        => 'GET',
                'url'         => $url . '/{id}/edit',
                'action'      => null,
                'request'     => 'Edit' . $model . 'Request',
                'task'        => null,
                'transporter' => null,
            ],
            [
                'stub'        => 'Update',
                'name'        => 'Update' . $model,
                'operation'   => 'update',
                'verb'        => 'PATCH',
                'url'         => $url . '/{id}',
                'action'      => 'Update' . $model . 'Action',
                'request'     => 'Update' . $model . 'Request',
                'task'        => 'Update' . $model . 'Task',
                'transporter' => 'Update' . $model . 'Transporter',
            ],
            [
                'stub'        => 'Delete',
                'name'        => 'Delete' . $model,
                'operation'   => 'delete',
                'verb'        => 'DELETE',
                'url'         => $url . '/{id}',
                'action'      => 'Delete' . $model . 'Action',
                'request'     => 'Delete' . $model . 'Request',
                'task'        => 'Delete' . $model . 'Task',
                'transporter' => 'Delete' . $model . 'Transporter',
            ],
        ];

        foreach ($routes as $route)
        {
            $this->call('apiato:generate:route', [
                '--container'   => $containerName,
                '--file'        => $route['name'],
                '--ui'          => $ui,
                '--operation'   => $route['operation'],
                '--doctype'     => $doctype,
                '--docversion'  => $version,
                '--url'         => $route['url'],
                '--verb'        => $route['verb'],
            ]);

            $enableTransporter = false;
            if ($useTransporters) {
                if ($route['transporter'] != null) {
                    $enableTransporter = true;
                }
            }

            $this->call('apiato:generate:request', [
                '--container'   => $containerName,
                '--file'        => $route['request'],
                '--ui'          => $ui,
                '--transporter' => $enableTransporter,
                '--transportername' => $route['transporter'],
            ]);

            if ($route['action'] != null || $route['stub'] != null) {
                $this->call('apiato:generate:action', [
                    '--container' => $containerName,
                    '--file' => $route['action'],
                    '--model' => $model,
                    '--stub' => $route['stub'],
                ]);
            }

            if ($route['task'] != null || $route['stub'] != null) {
                $this->call('apiato:generate:task', [
                    '--container' => $containerName,
                    '--file' => $route['task'],
                    '--model' => $model,
                    '--stub' => $route['stub'],
                ]);
            }
        }

        // finally generate the controller
        $this->printInfoMessage('Generating Controller to wire everything together');
        $this->call('apiato:generate:controller', [
            '--container'   => $containerName,
            '--file'        => 'Controller',
            '--ui'          => $ui,
            '--stub'        => 'crud.' . $ui,
        ]);

        $this->printInfoMessage('Generating Composer File');
        return [
            'path-parameters' => [
                'container-name' => $containerName,
            ],
            'stub-parameters' => [
                '_container-name' => $_containerName,
                'container-name' => $containerName,
                'class-name' => $this->fileName,
            ],
            'file-parameters' => [
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
        return 'composer';
    }

    public function getDefaultFileExtension()
    {
        return 'json';
    }

}
