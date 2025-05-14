<?php

namespace App\Http\Middleware;

use App\Http\Resources\LoggedInUserResource;
use App\Models\Setting;
use Auth;
use Illuminate\Foundation\Application;
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
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'app' => [
                'title' => Setting::get('app_title', 'Default Title'),
                'subtitle' => Setting::get('app_subtitle', 'Default SubTitle'),
                'version' => Auth::user() ? 'Laravel: v' . Application::VERSION . " (PHP: v" . PHP_VERSION . ")" : 'beta',
            ],
            'auth' => [
                'user' => $request->user() ? LoggedInUserResource::make($request->user()) : null,
                'roles' => $request->user()?->getRoleNames() ?? [],
                'permissions' => $request->user()?->getAllPermissions()?->pluck('name') ?? []
            ],
            'impersonation' => session()->has('impersonator_id') ? [
                'active' => true,
                'as' => $request->user()?->fullname,
            ] : null,
            'flash' => session('flash'),
            'csrf_token' => csrf_token(),
        ];
    }
}
