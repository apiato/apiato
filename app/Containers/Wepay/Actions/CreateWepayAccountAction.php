<?php

namespace App\Containers\Wepay\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Wepay\Data\Repositories\WepayAccountRepository;
use App\Containers\Wepay\Models\WepayAccount;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\App;

/**
 * Class CreateWepayAccountAction.
 *
 * @author Rockers Technologies <jaimin.rockersinfo@gmail.com>
 */
class CreateWepayAccountAction extends Action
{

    /**
     * @param string|null $name
     * @param string|null $description
     * @param string|null $type
     * @param string|null $imageUrl
     * @param string|null $gaqDomains
     * @param string|null $mcc
     * @param string|null $country
     * @param string|null $currencies
     * @param string|null $nickname
     *
     * @return  \App\Containers\Wepay\Models\WepayAccount
     */
    public function run(
        string $name = null,
        string $description = null,
        string $type = null,
        string $imageUrl = null,
        string $gaqDomains = null,
        string $mcc = null,
        string $country = null,
        string $currencies = null,
        string $nickname = null
    ): WepayAccount {

        $user = Apiato::call('Authentication@GetAuthenticatedUserTask');

        $wepayAccount = new WepayAccount();
        $wepayAccount->name = $name;
        $wepayAccount->description = $description;
        $wepayAccount->type = $type;
        $wepayAccount->imageUrl = $imageUrl;
        $wepayAccount->gaqDomains = json_decode($gaqDomains);
        $wepayAccount->mcc = $mcc;
        $wepayAccount->country = $country;
        $wepayAccount->currencies = $currencies;

        $wepayAccount = App::make(WepayAccountRepository::class)->create($wepayAccount->toArray());

        Apiato::call('Payment@AssignPaymentAccountToUserTask', [$wepayAccount, $user, $nickname]);

        return $wepayAccount;
    }

}
