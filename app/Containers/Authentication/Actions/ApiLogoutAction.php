<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
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
     * @var  \Lcobucci\JWT\Parser
     */
    private $parser;

    /**
     * ApiLogoutAction constructor.
     *
     * @param \Lcobucci\JWT\Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $token
     *
     * @return  bool
     */
    public function run($token)
    {
        $id = $this->parser->parse($token)->getHeader('jti');

        DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => true]);

        return true;
    }
}
