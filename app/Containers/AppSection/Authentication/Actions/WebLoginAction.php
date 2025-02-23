<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Classes\LoginFieldParser;
use App\Containers\AppSection\Authentication\Data\Dto\IncomingLoginField;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class WebLoginAction extends ParentAction
{
    public function run(array $data): RedirectResponse
    {
        $loginFields = LoginFieldParser::extractAll($data);
        $credentials = [];
        foreach ($loginFields as $loginField) {
            $credentials[$loginField->name] =
                static fn (Builder $query): Builder => $query
                    ->orWhereRaw("lower({$loginField->name}) = lower(?)", [$loginField->value]);
        }
        $credentials['password'] = $data['password'];

        $loggedIn = Auth::guard('web')->attempt($credentials, $data['remember'] ?? false);

        // TODO: This doesnt feels right. Maybe we should move this to controller?
        // You know, the controller should be the one who decides where to redirect the user.
        if ($loggedIn) {
            session()->regenerate();

            return redirect()->intended();
        }

        $errorResult = array_reduce(
            $loginFields,
            static fn (array $result, IncomingLoginField $loginField): array => [
                'errors' => array_merge($result['errors'], [$loginField->name => __('auth.failed')]),
                'fields' => array_merge($result['fields'], [$loginField->name]),
            ],
            ['errors' => [], 'fields' => []],
        );

        return back()->withErrors(
            $errorResult['errors'],
        )->onlyInput(...$errorResult['fields']);
    }
}
