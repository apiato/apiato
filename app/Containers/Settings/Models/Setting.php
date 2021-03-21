<?php

namespace App\Containers\Settings\Models;

use App\Ship\Parents\Models\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $table = 'settings';
    protected $fillable = [
        'key',
        'value',
    ];
}
