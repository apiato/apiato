<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
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
     * @param string $bearerToken
     *
     * @return  bool
     */
    public function run(string $bearerToken): bool
    {
        $id = App::make(Parser::class)->parse($bearerToken)->getHeader('jti');

        DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => true]);

        return true;
    }
}
