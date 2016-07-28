<?php

namespace App\Containers\Settings\Models;

use App\Port\Model\Abstracts\Model;

/**
 * Class Settings
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Settings extends Model
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
