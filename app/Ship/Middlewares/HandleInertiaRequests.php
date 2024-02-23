<?php

namespace App\Ship\Middlewares;

use App\Containers\AppSection\User\Data\Factories\UserFactory;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => static fn () => [
                'user' => UserFactory::new()->makeOne(),
//                'user' => $request->user() ? [
//                    'id' => $request->user()->id,
//                    'name' => $request->user()->name,
//                    'email' => $request->user()->email,
//                ] : null,
            ],
        ]);
    }
}
