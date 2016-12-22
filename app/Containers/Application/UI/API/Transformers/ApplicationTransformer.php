<?php

namespace App\Containers\Application\UI\API\Transformers;

use App\Containers\Application\Models\Application;
use App\Port\Transformer\Abstracts\Transformer;

/**
 * Class ApplicationTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApplicationTransformer extends Transformer
{

    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\Application\Models\Application $application
     *
     * @return  array
     */
    public function transform(Application $application)
    {
        return [
            'object'     => 'Application',
            'id'         => $application->getHashedKey(),
            'name'       => $application->name,
            'token'      => $application->token,
            'created_at' => $application->created_at,
        ];
    }


}
