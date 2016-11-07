<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use App\Containers\Authentication\Actions\WebAdminLoginAction;
use App\Containers\Authentication\Actions\WebLogoutAction;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Port\Controller\Abstracts\PortWebController;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends PortWebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('login');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     * @param \App\Containers\Authentication\Actions\WebAdminLoginAction  $action
     *
     * @return  $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginAdmin(LoginRequest $request, WebAdminLoginAction $action)
    {
        $result = $action->run($request->email, $request->password, $request->remember_me);

        if (is_array($result)) {
            return view('login')->with($result);
        }

        return view('dashboard');
    }

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDashboardPage()
    {
        return view('dashboard');
    }

    /**
     * @param \App\Containers\Authentication\Actions\WebLogoutAction $action
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logoutAdmin(WebLogoutAction $action)
    {
        $action->run();

        return view('login');
    }


}
