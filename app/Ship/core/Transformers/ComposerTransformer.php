<?php

namespace Apiato\Core\Transformers;

use Apiato\Core\Abstracts\Transformers\Transformer;
use stdClass;

/**
 * Class ComposerTransformer
 *
 * @author Fabian Widmann <fabian.widmann@gmail.com>
 */
class ComposerTransformer extends Transformer
{
    /**
     * @param stdClass $decodedJson
     * @return array
     */
    public function transform(stdClass $decodedJson)
    {
        $result = [
            'name' => $decodedJson->name,
            'description' => $decodedJson->name,
        ];

        if (isset($decodedJson->type)) {
            $result['type'] = $decodedJson->type;
        }

        if (isset($decodedJson->support)) {
            $result['support'] = (array)$decodedJson->support;
        }

        return $result;
    }
}
