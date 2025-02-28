<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Abstract\Repositories\Repository as AbstractRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends AbstractRepository<TModel>
 */
abstract class Repository extends AbstractRepository
{
}
