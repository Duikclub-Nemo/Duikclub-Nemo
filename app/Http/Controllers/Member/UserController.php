<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Resources\Member\CertificateUserIndexResource;
use App\Http\Resources\Member\UserIndexResource;
use App\Http\Resources\Member\UserShowResource;
use App\Models\CertificateUser;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Class UserController
 *
 * Handles listing and viewing of User resources within the Member section.
 * Applies permission middleware for listing and viewing actions.
 *
 * @package App\Http\Controllers\Member
 */
class UserController extends Controller implements HasMiddleware
{
    /**
     * Uses middleware to handle permission in the controller.
     * @return array
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:member.user.list', only: ['index']),
            new Middleware('permission:member.user.view', only: ['show']),
        ];
    }

    /**
     * Display a paginated listing of users.
     *
     * Validates query parameters, applies search, filters, and sorting,
     * then returns Inertia response with resources and options.
     *
     * @param Request $request HTTP request with query parameters.
     * @param UserRepository $repository Repository for filter options.
     * @return Response
     */
    public function index(Request $request, UserRepository $repository): Response
    {
        // Validate incoming filter and sort parameters
        $request->validate([
            'search' => ['nullable', 'string'],
            'field' => ['nullable', 'in:first_name,last_name,place,certificate,role'],
            'direction' => ['nullable', 'in:asc,desc'],
            'places' => ['nullable', 'string'],
            'certificates' => ['nullable', 'string'],
            'roles' => ['nullable', 'string'],
        ]);

        // Prepare filter options for the UI
        $filterOptions = [
            [
                'column' => 'places',
                'label' => 'Woonplaats',
                'choices' => $repository->getPlacesFilter(),
            ],
            [
                'column' => 'certificates',
                'label' => 'Brevet',
                'choices' => $repository->getCertificatesForFiltering(),
            ],
            [
                'column' => 'roles',
                'label' => 'Rol',
                'choices' => $repository->getRolesFilter(),
            ],
        ];

        // Sorting options for the UI
        $sortOptions = [
            [
                'column' => 'first_name',
                'label' => 'Voornaam',
            ],
            [
                'column' => 'last_name',
                'label' => 'Achternaam',
            ]
        ];

        // Build the users a query with search, filters, and sorting
        $users = User::query()
            ->active()
            ->visible()
            ->search($request->input('search'))
            ->filterByColumn('place', $request->filled('places') ? explode(',', $request->input('places')) : [])
            ->filterByCertificates($request->filled('certificates') ? explode(',', $request->input('certificates')) : [])
            ->filterByRoles($request->filled('roles') ? explode(',', $request->input('roles')) : [])
            ->sortByField($request->input('field'), $request->input('direction'))
            ->paginate(10, pageName: 'pagina')
            ->withQueryString();

        return Inertia::render('Member/User/Index', [
            'users' => fn() => UserIndexResource::collection($users),
            'filters' => $request->only(['search', 'field', 'direction', 'places', 'certificates', 'roles']),
            'filterOptions' => fn() => $filterOptions,
            'sortOptions' => fn() => $sortOptions,
        ]);
    }

    /**
     * Display the specified user resource.
     *
     * Ensures the user is active and visible before rendering.
     *
     * @param User $user User model instance bound by route.
     * @return Response
     */
    public function show(User $user)
    {
        // Abort if the user is deleted or not visible
        if (!$user->isActive() || !$user->display_userlist) {
            abort(404);
        }

        return Inertia::render('Member/User/Show', [
            'user' => fn() => UserShowResource::make($user),
            'certificates' => Inertia::defer(fn() => CertificateUserIndexResource::collection(
                CertificateUser::where('user_id', $user->id)
                    ->with(['certificate'])
                    ->orderBy('date_of_issue', 'desc')
                    ->get()
            )),
        ]);
    }

}
