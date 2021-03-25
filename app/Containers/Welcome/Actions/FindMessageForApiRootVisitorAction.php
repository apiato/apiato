<?php

namespace App\Containers\Welcome\Actions;

use App\Ship\Parents\Actions\Action;

class FindMessageForApiRootVisitorAction extends Action
{
    public function run(): array
    {
        return [trans('welcome::messages.welcome')];
    }
}
