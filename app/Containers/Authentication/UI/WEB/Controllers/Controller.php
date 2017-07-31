<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use App\Containers\Authentication\Actions\WebAdminLoginAction;
use App\Containers\Authentication\Actions\WebLogoutAction;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\ViewDashboardRequest;
use App\Ship\Parents\Controllers\WebController;
use Exception;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('authentication::login');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginAdmin(LoginRequest $request)
    {
        try {
            $result = $this->call(WebAdminLoginAction::class, [$request]);
        } catch (Exception $e) {
            return redirect('login')->with('status', $e->getMessage());
        }

        return is_array($result) ? redirect('login')->with($result) : redirect('dashboard');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\ViewDashboardRequest $request
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDashboardPage(ViewDashboardRequest $request)
    {
        return view('authentication::dashboard');
    }

    /**
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutAdmin()
    {
        $this->call(WebLogoutAction::class);

        return redirect('login');
    }

}
