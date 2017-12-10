<?php

namespace App\Containers\Wepay\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Wepay\Data\Repositories\WepayAccountRepository;
use App\Containers\Wepay\Models\WepayAccount;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;

/**
 * Class CreateWepayAccountAction.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\Wepay\Models\WepayAccount
     */
    public function run(DataTransporter $data): WepayAccount
    {
        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $wepayAccount = new WepayAccount();
        $wepayAccount->name = $data->name;
        $wepayAccount->description = $data->description;
        $wepayAccount->type = $data->type;
        $wepayAccount->imageUrl = $data->imageUrl;
        $wepayAccount->gaqDomains = json_decode($data->gaqDomains);
        $wepayAccount->mcc = $data->mcc;
        $wepayAccount->country = $data->country;
        $wepayAccount->currencies = $data->currencies;

        $wepayAccount = App::make(WepayAccountRepository::class)->create($wepayAccount->toArray());

        Apiato::call('Payment@AssignPaymentAccountToUserTask', [$wepayAccount, $user, $data->nickname]);

        return $wepayAccount;
    }

}
