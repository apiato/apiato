<?php

namespace App\Containers\Tracker\Models;

use App\Containers\User\Models\User;
use App\Port\Model\Abstracts\Model;

/**
 * Class TimeTracker.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class TimeTracker extends Model
{

    const PENDING = 'PENDING';
    const FAILED = 'FAILED';
    const SUCCEEDED = 'SUCCEEDED';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'time_tracker';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'open_at',
        'close_at',
        'status',
        'user_id',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'open_at',
        'close_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
