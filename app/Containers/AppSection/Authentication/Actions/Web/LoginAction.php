<?php

namespace App\Containers\AppSection\Authentication\Actions\Web;

use App\Ship\Parents\Actions\Action as ParentAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

final class LoginAction extends ParentAction
{
    public function run(string $email, string $password, bool $remember): RedirectResponse
    {
        $credentials = [
            'email' => static fn (Builder $query): Builder => $query
                ->orWhereRaw('lower(email) = lower(?)', [$email]),
            'password' => $password,
        ];

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            session()?->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    }
}
