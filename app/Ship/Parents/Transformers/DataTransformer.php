<?php

namespace App\Ship\Parents\Transformers;

class DataTransformer extends Transformer
{
    public function transform($data)
    {

        $response = json_decode(json_encode($data), true);
        if (isset($response['data']) && !empty($response['data'])) {
            $response['data'] = json_decode($response['data']);
        }

        return  $response;
    }
}
