<?php

namespace App\Repositories;

use App\Enums\CertificateTypeEnum;
use App\Enums\RoleEnum;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRepository
{

    /**
     * Get places for userlist filtering
     *
     * @param bool $archived
     * @param bool $hidden
     * @param bool $onlyTrashed
     * @return Collection
     */
    public function getPlacesFilter(
        bool $archived = false,
        bool $hidden = false,
        bool $onlyTrashed = false,
    ): Collection
    {
        $query = User::query()
            ->select('place', DB::raw('CAST(COUNT(*) AS SIGNED) AS count'))
            ->whereNotNull('place')
            ->when($onlyTrashed, fn($q) => $q->onlyTrashed())
            ->when(!$archived, fn($q) => $q->active())
            ->when(!$hidden, fn($q) => $q->visible())
            ->groupBy('place')
            ->orderBy('place');

        return $query
            ->get()
            ->map(fn($row) => [
                'value' => $row->place,
                'label' => $row->place,
                'count' => (int)$row->count,
            ]);
    }

    /**
     * Get the highest certificate for userlist filtering
     *
     * @param bool $archived
     * @param bool $hidden
     * @param bool $onlyTrashed
     * @return Collection
     */
    public function getCertificatesForFiltering(
        bool $archived = false,
        bool $hidden = false,
        bool $onlyTrashed = false,
    ): Collection
    {
        $userIds = User::query()
            ->when($onlyTrashed, fn($q) => $q->onlyTrashed())
            ->when(!$archived, fn($q) => $q->active())
            ->when(!$hidden, fn($q) => $q->visible())
            ->pluck('id');

        $certificatesQuery = Certificate::select([
            'certificates.id AS value',
            'certificates.title AS label',
            DB::raw('COUNT(DISTINCT users.id) as count')
        ])
            ->join('certificate_user', 'certificates.id', '=', 'certificate_user.certificate_id')
            ->join('users', 'certificate_user.user_id', '=', 'users.id')
            ->where('certificates.certificate_type', CertificateTypeEnum::REGULAR)
            ->whereIn('users.id', $userIds)
            ->whereIn('certificates.id', function ($query) {
                $query->selectRaw('MAX(certificates.id)')
                    ->from('certificates')
                    ->join('certificate_user as cu', 'certificates.id', '=', 'cu.certificate_id')
                    ->whereColumn('cu.user_id', 'certificate_user.user_id')
                    ->where('certificates.certificate_type', CertificateTypeEnum::REGULAR)
                    ->groupBy('cu.user_id');
            })
            ->groupBy('certificates.id', 'certificates.title')
            ->orderBy('value');

        $usersWithoutCertificatesQuery = User::query()
            ->whereDoesntHave('certificates_regular')
            ->when($onlyTrashed, fn($q) => $q->onlyTrashed())
            ->when(!$archived, fn($q) => $q->active())
            ->when(!$hidden, fn($q) => $q->visible());

        return $certificatesQuery->get()
            ->prepend([
                'value' => '0',
                'label' => 'In opleiding',
                'count' => $usersWithoutCertificatesQuery->count()
            ]);
    }

    /**
     * Get assigned roles for userlist filtering
     *
     * @param bool $archived
     * @param bool $hidden
     * @param bool $onlyTrashed
     * @return Collection
     */
    public function getRolesFilter(
        bool $archived = false,
        bool $hidden = false,
        bool $onlyTrashed = false,
    ): Collection
    {
        $userIds = User::query()
            ->when($onlyTrashed, fn($q) => $q->onlyTrashed())
            ->when(!$archived, fn($q) => $q->active())
            ->when(!$hidden, fn($q) => $q->visible())
            ->pluck('id');

        $query = Role::select(
            'roles.id AS value',
            'roles.name AS label',
            DB::raw('COUNT(model_has_roles.model_id) as count'))
            ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->whereIn('users.id', $userIds)
            ->groupBy('roles.id', 'roles.name')
            ->orderBy('roles.name');

        return $query->get()->map(function ($role) {
            $roleEnum = RoleEnum::tryFrom($role->label);
            $role->label = $roleEnum ? $roleEnum->getReadableText() : $role->label;
            return $role;
        });
    }

    /**
     * Get assigned certificate types for certificate filtering
     *
     * @param User $user
     * @return Collection
     */
    public function getCertificateTypeForUser(
        User $user,
    ): Collection
    {
        $query = Certificate::select(
            'certificates.certificate_type AS value',
            'certificates.certificate_type AS label',
            DB::raw('COUNT(certificate_user.certificate_id) AS count')
        )
            ->join('certificate_user', 'certificates.id', '=', 'certificate_user.certificate_id')
            ->where('certificate_user.user_id', $user->id)
            ->groupBy('certificates.certificate_type')
            ->orderBy('certificates.certificate_type');

        return $query->get()->map(function ($type) {
            $enum = CertificateTypeEnum::tryFrom($type->label);
            $type->label = $enum ? $enum->getReadableText() : $type->label;
            return $type;
        });

    }

}
