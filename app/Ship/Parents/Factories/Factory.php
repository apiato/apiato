<?php

declare(strict_types=1);

namespace App\Ship\Parents\Factories;

use Apiato\Core\Abstracts\Factories\Factory as AbstractFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends AbstractFactory<TModel>
 */
abstract class Factory extends AbstractFactory
{
}
