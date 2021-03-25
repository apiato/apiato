<?php

namespace App\Containers\Welcome\Actions;

use App\Ship\Parents\Actions\Action;

class FindMessageForApiV1VisitorAction extends Action
{
    public function run(): array
    {
        return [trans('welcome::messages.welcome') . ' (API V1)'];
    }
}
