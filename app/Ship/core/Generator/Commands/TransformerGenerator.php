<?php

namespace Apiato\Core\Generator\Commands;

use Apiato\Core\Generator\GeneratorCommand;
use Apiato\Core\Generator\Interfaces\ComponentsGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class TransformerGenerator
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class TransformerGenerator extends GeneratorCommand implements ComponentsGenerator
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'apiato:generate:transformer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Transformer class for a given Model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $fileType = 'Transformer';

    /**
     * The structure of the file path.
     *
     * @var  string
     */
    protected $pathStructure = '{container-name}/UI/API/Transformers/*';

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
    protected $stubName = 'transformer.stub';

    /**
     * User required/optional inputs expected to be passed while calling the command.
     * This is a replacement of the `getArguments` function "which reads whenever it's called".
     *
     * @var  array
     */
    public $inputs = [
        ['model', null, InputOption::VALUE_OPTIONAL, 'The model to generate this Transformer for'],
        ['full', null, InputOption::VALUE_OPTIONAL, 'Generate a Transformer with all fields of the model'],
    ];

    /**
     * @return array
     */
    public function getUserInputs()
    {
        $model = $this->checkParameterOrAsk('model', 'Enter the name of the Model to generate this Transformer for');
        $full = $this->checkParameterOrConfirm('full', 'Generate a Transformer with all fields', false);

        $attributes = $this->getListOfAllAttributes($full, $model);

        return [
            'path-parameters' => [
                'container-name' => $this->containerName,
            ],
            'stub-parameters' => [
                '_container-name' => Str::lower($this->containerName),
                'container-name' => $this->containerName,
                'class-name' => $this->fileName,
                'model' => $model,
                'attributes' => $attributes,
            ],
            'file-parameters' => [
                'file-name' => $this->fileName,
            ],
        ];
    }

    private function getListOfAllAttributes($full, $model) {
        $indent = str_repeat(' ', 12);
        $fields = [
            'object' => "'$model'",
        ];

        if($full) {
            $obj = 'App\\Containers\\' . $this->containerName . '\\Models\\' . $model;
            $obj = new $obj();
            $columns = Schema::getColumnListing($obj->getTable());

            foreach($columns as $column) {
                if(in_array($column, $obj->getHidden())) {
                    // skip all hidden fields of respective model
                    continue;
                }

                $fields[$column] = '$entity->' . $column;
            }
        }

        $fields = array_merge($fields, [
            'id' => '$entity->getHashedKey()',
            'created_at' => '$entity->created_at',
            'updated_at' => '$entity->updated_at'
        ]);

        $attributes = "";
        foreach($fields as $key => $value) {
            $attributes = $attributes . $indent . "'$key' => $value," . PHP_EOL;
        }

        return $attributes;
    }

}
