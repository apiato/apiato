<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginFieldProcessor;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\AppSection\Authentication\Values\IncomingLoginField;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends ParentAction
{
    /**
     * @throws IncorrectIdException
     */
    public function run(LoginRequest $request): RedirectResponse
    {
        $sanitizedData = $request->sanitizeInput([
            ...array_keys(config('appSection-authentication.login.fields', ['email' => []])),
            'password',
            'remember' => false,
        ]);

        $loginFields = LoginFieldProcessor::extractAll($sanitizedData);
        $credentials = [];
        foreach ($loginFields as $loginField) {
            if (config('appSection-authentication.login.case_sensitive')) {
                $credentials[$loginField->name] =
                    static fn (Builder $query): Builder => $query->orWhere($loginField->name, $loginField->value);
            } else {
                $credentials[$loginField->name] =
                    static fn (Builder $query): Builder => $query->orWhereRaw("lower({$loginField->name}) = lower(?)", [$loginField->value]);
            }
        }
        $credentials['password'] = $sanitizedData['password'];

        $loggedIn = Auth::guard('web')->attempt($credentials, $sanitizedData['remember']);

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
