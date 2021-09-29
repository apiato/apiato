<?php

namespace App\Ship\Parents\Transformers;

use Apiato\Core\Abstracts\Transformers\Transformer as AbstractTransformer;
use Illuminate\Support\Facades\Auth;

abstract class Transformer extends AbstractTransformer
{
    /**
     * @param $adminResponse
     * @param $clientResponse
     *
     * @return  array
     */
    public function ifAdmin($adminResponse, $clientResponse): array
    {
        $user = Auth::user();

        if (!is_null($user) && $user->hasAdminRole()) {
            return array_merge($clientResponse, $adminResponse);
        }

        return $clientResponse;
    }
}
