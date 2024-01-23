<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Classes\LoginCustomAttribute;
use App\Containers\AppSection\Authentication\UI\WEB\Requests\LoginRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WebLoginAction extends ParentAction
{
    /**
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(LoginRequest $request): RedirectResponse
    {
        $sanitizedData = $request->sanitizeInput([
            'email',
            'password',
            'remember_me' => false,
        ]);

        [$loginFieldValue, $loginFieldName] = LoginCustomAttribute::extract($sanitizedData);
        if (config('appSection-authentication.login.case_sensitive')) {
            $credentials = [
                $loginFieldName => $loginFieldValue,
                'password' => $sanitizedData['password'],
            ];
        } else {
            $credentials = [
                $loginFieldName => static fn (Builder $query) => $query->whereRaw("lower({$loginFieldName}) = lower(?)", [$loginFieldValue]),
                'password' => $sanitizedData['password'],
            ];
        }

        $loggedIn = Auth::guard('web')->attempt($credentials, $sanitizedData['remember_me']);

        if ($loggedIn) {
            session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            $loginFieldName => 'The provided credentials do not match our records.',
        ])->onlyInput($loginFieldName);
    }
}
