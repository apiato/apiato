<?php

namespace App\Containers\Application\Models;

use App\Containers\User\Models\User;
use App\Port\Model\Abstracts\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Application.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class Application extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'token',
        'user_id',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
