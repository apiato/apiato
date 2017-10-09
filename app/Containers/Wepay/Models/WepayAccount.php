<?php

namespace App\Containers\Wepay\Models;

use App\Containers\Payment\Models\AbstractPaymentAccount;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WepayAccount
 *
 * @author  Rockers Technologies <jaimin.rockersinfo@gmail.com>
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class WepayAccount extends AbstractPaymentAccount
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'type',
        'imageUrl',
        'gaqDomains',
        'mcc',
        'country',
        'currencies',
        'userId',
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

    /**
     * @return string
     */
    public function getPaymentGatewayReadableName()
    {
        return 'Wepay';
    }

    /**
     * @return string
     */
    public function getPaymentGatewaySlug()
    {
        return 'wepay';
    }
}
