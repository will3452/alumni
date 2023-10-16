<?php

namespace App\Http\Middleware;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $menu = [
            [
                'label' => 'Dashboard',
                'href' => '/dashboard',
                'icon' => 'dashboard',
            ],

            [
                'label' => 'Post News & Job Offer',
                'href' => '/posts',
                'icon' => 'feed',
            ],

            [
                'label' => 'Notifications',
                'href' => '/notifications',
                'icon' => 'notifications',
            ],

        ];

        if (Auth::check() && in_array(Auth::user()->type, ['Coordinator', 'Alumni'])) {
            array_push($menu,
                [
                    'label' => 'Donations',
                    'href' => '/donations',
                    'icon' => 'volunteer_activism',
                ], );
        }

        if (Auth::check() && in_array(Auth::user()->type, ['Administrator'])) {
            array_push($menu, [
                'label' => 'Careers',
                'href' => '/careers',
                'icon' => 'work',
            ]);
            array_push($menu, [
                'label' => 'Reports',
                'href' => '/reports',
                'icon' => 'table_view',
            ]);
        }

        array_push($menu,
            [
                'label' => 'Profile',
                'href' => '/profile',
                'icon' => 'person',
            ]);
        return array_merge(parent::share($request), [
            'appName' => env('APP_NAME'),
            'appUrl' => env('APP_URL'),
            'auth' => Auth::check(),
            'user' => Auth::user(),
            'careers' => Career::with('items')->get(),
            'menu' => $menu,
        ]);
    }
}
