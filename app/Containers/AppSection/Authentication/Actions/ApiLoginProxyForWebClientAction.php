<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Classes\LoginFieldParser;
use App\Containers\AppSection\Authentication\Data\Dto\AuthResult;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailed;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshTokenCookieTask;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ApiLoginProxyForWebClientAction extends ParentAction
{
    public function __construct(
        private readonly CallOAuthServerTask $callOAuthServerTask,
        private readonly MakeRefreshTokenCookieTask $makeRefreshTokenCookieTask,
    ) {
    }

    /**
     * @throws LoginFailed
     * @throws \Exception
     */
    public function run(array $data): AuthResult
    {
        $loginFields = LoginFieldParser::extractAll($data);

        $exception = null;
        foreach ($loginFields as $loginField) {
            $data['username'] = $loginField->value;

            try {
                $token = $this->callOAuthServerTask->run($data);
                $refreshTokenCookie = $this->makeRefreshTokenCookieTask->run($token->refreshToken);

                return new AuthResult($token, $refreshTokenCookie);
            } catch (LoginFailed $e) {
                $exception = $e;
                // try the next login field
            }
        }

        throw $exception;
    }
}
