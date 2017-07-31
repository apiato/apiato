<?php

namespace App\Containers\Settings\Models;

use App\Ship\Parents\Models\Model;

/**
 * Class Setting
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Setting extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var  bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
