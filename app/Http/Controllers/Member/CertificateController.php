<?php

namespace App\Http\Controllers\Member;

use App\Enums\CertificateStatusEnum;
use App\Enums\CertificateTypeEnum;
use App\Enums\FederationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CertificateStoreRequest;
use App\Http\Resources\Member\CertificateUserEditResource;
use App\Http\Resources\Member\CertificateUserIndexResource;
use App\Http\Resources\Member\CertificateUserShowResource;
use App\Models\Certificate;
use App\Models\CertificateUser;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Controller for managing member certificates.
 *
 * Handles listing, viewing, creating, editing, and deleting of certificates for authenticated users.
 */
class CertificateController extends Controller implements HasMiddleware
{

    /**
     * Define permissions middleware for each action.
     *
     * @return array<int, Middleware>
     */
    public static function middleware(): array
    {
        return [
            new Middleware('permission:member.certificate.list|member.certificate.view|member.certificate.create|member.certificate.edit|member.certificate.delete', only: ['index']),
            new Middleware('permission:member.certificate.view', only: ['show']),
            new Middleware('permission:member.certificate.create', only: ['create', 'store']),
            new Middleware('permission:member.certificate.edit', only: ['edit', 'update']),
            new Middleware('permission:member.certificate.delete', only: ['destroy']),
        ];
    }

    /**
     * Display a paginated list of the user's active certificates.
     *
     * @param Request $request HTTP request containing filters and sorting.
     * @param UserRepository $repository Repository for user-specific data.
     * @return Response
     */
    public function index(Request $request, UserRepository $repository): Response
    {
        $user = auth()->user();

        // Validate incoming filter and sort parameters
        $request->validate([
            'search' => ['nullable', 'string'],
            'field' => ['nullable', 'in:date_of_issue'],
            'direction' => ['nullable', 'in:asc,desc'],
            'certificate_type' => ['nullable', 'string'],
        ]);

        // Prepare filter options for the UI
        $filterOptions = [
            [
                'column' => 'certificate_type',
                'label' => 'Type',
                'choices' => $repository->getCertificateTypeForUser($user),
            ]
        ];

        // Sorting options for the UI
        $sortOptions = [
            [
                'column' => 'date_of_issue',
                'label' => 'Datum',
            ],
        ];

        $certificate_user = CertificateUser::with('certificate')
            ->active()
            ->where('user_id', $user->id)
            ->search($request->input('search'))
            ->filterByColumn('certificate_type', $request->filled('certificate_type') ? explode(',', $request->input('certificate_type')) : [])
            ->when(
                $request->input('field') === 'date_of_issue',
                fn($q) => $q->orderBy('date_of_issue', $request->input('direction')),
                fn($q) => $q->orderBy('date_of_issue', 'desc')
            )
            ->paginate();

        return Inertia::render('Member/Certificate/Index', [
            'certificates' => fn() => CertificateUserIndexResource::collection($certificate_user),
            'filters' => $request->only(['search', 'field', 'direction', 'certificate_type']),
            'filterOptions' => fn() => $filterOptions,
            'sortOptions' => fn() => $sortOptions,
        ]);
    }

    /**
     * Display details for a specific certificate.
     *
     * @param CertificateUser $certificateUser Certificate instance from route-model binding.
     * @return Response
     */
    public function show(CertificateUser $certificateUser): Response
    {
        // Only show if the certificate is active; otherwise, 404
        if (!$certificateUser->isActive()) {
            abort(404);
        }

        // Eager load related certificate data
        $certificateUser->load(['certificate']);

        return Inertia::render('Member/Certificate/Show', [
            'certificate' => CertificateUserShowResource::make($certificateUser),
        ]);
    }

    /**
     * Show form for creating a new certificate entry.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Member/Certificate/Create', [
            'types' => CertificateTypeEnum::getSelectList(),
            'certificates' => $this->getCertificates(),
            'federations' => FederationEnum::getSelectList(),
        ]);
    }

    /**
     * Store a newly created certificate in storage.
     *
     * @param CertificateStoreRequest $request Validated request data.
     * @return RedirectResponse
     */
    public function store(CertificateStoreRequest $request): RedirectResponse
    {
        // Create a new certificate record for the authenticated user
        $certificate = CertificateUser::create([
            'user_id' => auth()->id(),
            'certificate_id' => $request->certificate_id,
            'date_of_issue' => $request->date_of_issue,
            'certificate_number' => $request->certificate_number,
            'federation' => $request->federation,
            'created_by' => auth()->id(),
        ]);

        return redirect(route('member.certificate.show', $certificate->id))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je brevet is toegevoegd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Show a form for editing an existing certificate.
     *
     * @param CertificateUser $certificateUser
     * @return Response
     */
    public function edit(CertificateUser $certificateUser): Response
    {
        // Only show if the certificate is active; otherwise, 404
        if (!$certificateUser->isActive()) {
            abort(404);
        }

        return Inertia::render('Member/Certificate/Edit', [
            'certificate' => CertificateUserEditResource::make($certificateUser->load(['certificate'])),
            'types' => CertificateTypeEnum::getSelectList(),
            'certificates' => $this->getCertificates(),
            'federations' => FederationEnum::getSelectList(),
        ]);
    }

    /**
     * Update the specified certificate in storage.
     *
     * @param CertificateStoreRequest $request
     * @param CertificateUser $certificateUser
     * @return RedirectResponse
     */
    public function update(CertificateStoreRequest $request, CertificateUser $certificateUser): RedirectResponse
    {
        // Update fields on the certificate record
        $certificateUser->update([
            'certificate_id' => $request->certificate_id,
            'date_of_issue' => $request->date_of_issue,
            'certificate_number' => $request->certificate_number,
            'federation' => $request->federation,
            'updated_by' => auth()->id(),
        ]);

        return redirect(route('member.certificate.show', $certificateUser->id))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je brevet is gewijzigd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Soft-delete the specified certificate by marking deleted_by and deleted_at.
     *
     * @param CertificateUser $certificateUser Certificate instance to delete.
     * @return RedirectResponse
     */
    public function destroy(CertificateUser $certificateUser): RedirectResponse
    {
        // Mark as soft-deleted
        $certificateUser->update([
            'deleted_by' => auth()->id(),
            'deleted_at' => now(),
        ]);

        return redirect(route('member.certificate.index'))->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Je brevet is verwijderd.',
                'duration' => 2000,
            ]
        ]);
    }

    /**
     * Get a list of certificates available for selection.
     *
     * @return Collection<int, array{value:int,label:string,certificate_type:string}>
     */
    private function getCertificates(): Collection
    {
        return Certificate::where('status', CertificateStatusEnum::PRIVATE)
            ->orWhere('status', CertificateStatusEnum::PUBLIC)
            ->select([
                'id as value',
                'title as label',
                'certificate_type',
            ])
            ->get();
    }

}
