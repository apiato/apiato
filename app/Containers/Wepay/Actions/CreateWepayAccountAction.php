<?php

namespace App\Containers\Wepay\Actions;

use App\Containers\Wepay\Data\Repositories\wepayAccountRepository;
use App\Containers\Wepay\Models\WepayAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\App;

/**
 * Class CreateWepayAccountAction.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  mixed
     */
    public function run(Request $request)
    {
        $wepayAccount = new WepayAccount();
        $wepayAccount->name         = $request->name;
        $wepayAccount->description  = $request->description;
        $wepayAccount->type         = $request->type;
        $wepayAccount->imageUrl     = $request->imageUrl;
        $wepayAccount->gaqDomains   = json_decode($request->gaqDomains);
        $wepayAccount->mcc          = $request->mcc;
        $wepayAccount->country      = $request->country;
        $wepayAccount->currencies   = $request->currencies;
        $wepayAccount->user()->associate($request->user());
       
        return $wepayAccount = App::make(wepayAccountRepository::class)->create($wepayAccount->toArray());
    }

}
