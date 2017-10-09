<?php

namespace App\Containers\Wepay\Actions;

use App\Containers\Wepay\Data\Repositories\WepayAccountRepository;
use App\Containers\Wepay\Models\WepayAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
use Illuminate\Support\Facades\App;
use Apiato\Core\Foundation\Facades\Apiato;

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
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $wepayAccount = new WepayAccount();
        $wepayAccount->name = $request->name;
        $wepayAccount->description = $request->description;
        $wepayAccount->type = $request->type;
        $wepayAccount->imageUrl = $request->imageUrl;
        $wepayAccount->gaqDomains = json_decode($request->gaqDomains);
        $wepayAccount->mcc = $request->mcc;
        $wepayAccount->country = $request->country;
        $wepayAccount->currencies = $request->currencies;

        $wepayAccount = App::make(WepayAccountRepository::class)->create($wepayAccount->toArray());

        $result = Apiato::call('Payment@AssignPaymentAccountToUserTask', [$wepayAccount, $user, $request->nickname]);

        return $result;
    }

}
