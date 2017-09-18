<?php

namespace App\Containers\Payment\UI\API\Transformers;

use App\Containers\Payment\Models\PaymentAccount;
use App\Ship\Parents\Transformers\Transformer;

class PaymentAccountTransformer extends Transformer
{

    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param PaymentAccount $entity
     *
     * @return array
     */
    public function transform(PaymentAccount $entity)
    {
        $response = [

            'object' => 'PaymentAccount',
            'id'     => $entity->getHashedKey(),

            'name' => $entity->name,

            'account' => [
                'type' => $entity->accountable->getPaymentGatewayReadableName(),
                'id'   => $entity->accountable->getHashedKey(),
                'slug' => $entity->accountable->getPaymentGatewaySlug(),
            ],

            'details' => $entity->accountable->getDetailAttributes(),

            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,
        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
