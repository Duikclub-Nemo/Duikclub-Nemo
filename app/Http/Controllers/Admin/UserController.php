<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\UserIndexResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller implements HasMiddleware
{
    /**
     * Define permissions middleware for each action.
     *
     * @return array<int, Middleware>
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:user.viewAny|user.create|user.activate|user.edit|user.delete|user.restore', only: ['index', 'show']),
            new Middleware('permission:' . PermissionEnum::USER_CREATE->value, only: ['create', 'store']),
            new Middleware('permission:' . PermissionEnum::USER_ACTIVATE->value, only: ['activate', 'store']),
            new Middleware('permission:' . PermissionEnum::USER_EDIT->value, only: ['edit', 'update']),
            new Middleware('permission:' . PermissionEnum::USER_DELETE->value, only: ['destroy']),
            new Middleware('permission:' . PermissionEnum::USER_RESTORE->value, only: ['restore']),
        ];
    }

    /**
     * Display a listing of the users.
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
            'active' => ['nullable', 'boolean'],
        ]);

        $archived = $request->archived && Gate::authorize(PermissionEnum::USER_VIEWANY->value);

        // Prepare filter options for the UI
        $filterOptions = [
            [
                'column' => 'places',
                'label' => 'Woonplaats',
                'choices' => $repository->getPlacesFilter(archived: true, onlyTrashed: $archived),
            ],
            [
                'column' => 'certificates',
                'label' => 'Brevet',
                'choices' => $repository->getCertificatesForFiltering(archived: true, onlyTrashed: $archived),
            ],
            [
                'column' => 'roles',
                'label' => 'Rol',
                'choices' => $repository->getRolesFilter(archived: true, onlyTrashed: $archived),
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
            ->when($archived, fn($q) => $q->onlyTrashed())
            ->search($request->input('search'))
            ->filterByColumn('place', $request->filled('places') ? explode(',', $request->input('places')) : [])
            ->filterByCertificates($request->filled('certificates') ? explode(',', $request->input('certificates')) : [])
            ->filterByRoles($request->filled('roles') ? explode(',', $request->input('roles')) : [])
            ->sortByField($request->input('field'), $request->input('direction'))
            ->paginate(10, pageName: 'pagina')
            ->withQueryString();

        return Inertia::render('Admin/User/Index', [
            'users' => fn() => UserIndexResource::collection($users),
            'filters' => $request->only(['search', 'field', 'direction', 'places', 'certificates', 'roles', 'archived']),
            'filterOptions' => fn() => $filterOptions,
            'sortOptions' => fn() => $sortOptions,
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/User/Create', [

        ]);
    }

    /**
     * Show the form for activating a user.
     */
    public function activate(User $user): Response
    {
        return Inertia::render('Admin/User/Activate', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect(route('admin.user.index'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Het lid is toegevoegd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): Response
    {
        if ($user->trashed() && ! auth()->user()->can(PermissionEnum::USER_VIEWANY->value)) {
            abort(404);
        }

        return Inertia::render('Admin/User/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user): Response
    {
        return Inertia::render('Admin/User/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        return redirect(route('admin.user.index'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Het lid is gewijzigd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        return redirect(route('admin.user.index'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Het lid is verwijderd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Restore the specified user from storage.
     */
    public function restore(User $user): RedirectResponse
    {
        return redirect(route('admin.user.index'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Het lid is hersteld.',
                'duration' => 2000,
            ]
        ]);
    }

}
