<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  bool
     */
    public function run(DataTransporter $data): bool
    {
        $id = App::make(Parser::class)->parse($data->bearerToken)->getClaim('jti');

        DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => true]);

        return true;
    }
}
