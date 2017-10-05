<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;
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
     * @param \App\Ship\Parents\Requests\Request $request
     *
     * @return  bool
     */
    public function run(Request $request)
    {
        $id = App::make(Parser::class)->parse($request->bearerToken())->getHeader('jti');

        DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => true]);

        return true;
    }
}
