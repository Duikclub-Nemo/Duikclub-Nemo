<?php

namespace App\Models;

use App\Enums\CertificateTypeEnum;
use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use App\Traits\HasOwnership;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

/**
 * Class User
 *
 * Represents a member of Duikclub Nemo with authentication, profile,
 * and customizable notification preferences.
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /**
     * Enable factory for testing/seeding and include common traits.
     *
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable, HasRoles, HasOwnership, SoftDeletes;

    /**
     * Attributes that can be mass assigned.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'email',
        'password',
        'first_name',
        'initials',
        'last_name',
        'gender',
        'date_of_birth',
        'street',
        'zipcode',
        'place',
        'country_id',
        'phone_number',
        'about_me',
        'avatar',
        'medical_check',
        'dives',
        'federation',
        'federation_membership',
        'ice_name',
        'ice_phone_number',
        'privacy_mode',
        'display_userlist',
        'accepted_terms',
        'last_online',
        'last_visited',
        'notify_push_admin',
        'notify_push_news_added',
        'notify_push_news_edited',
        'notify_push_activity_added',
        'notify_push_activity_edited',
        'notify_push_activity_removed',
        'notify_push_activity_reminder',
        'notify_push_activity_reminder_minutes_before',
        'notify_push_subscription_added',
        'notify_push_subscription_edited',
        'notify_push_subscription_removed',
        'notify_mail_admin',
        'notify_mail_news_added',
        'notify_mail_news_edited',
        'notify_mail_activity_added',
        'notify_mail_activity_edited',
        'notify_mail_activity_removed',
        'notify_mail_activity_reminder',
        'notify_mail_activity_reminder_minutes_before',
        'notify_mail_subscription_added',
        'notify_mail_subscription_edited',
        'notify_mail_subscription_removed',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Attributes hidden from array/JSON serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting definitions for dates, enums, booleans, etc.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date:Y-m-d',
            'medical_check' => 'date:Y-m-d',
            'last_online' => 'datetime',
            'accepted_terms' => 'datetime',
            'gender' => GenderEnum::class,
            'federation' => FederationEnum::class,
            'about_me' => PurifyHtmlOnGet::class,
//            'phone_number' => RawPhoneNumberCast::class . ':NL',
//            'ice_phone_number' => RawPhoneNumberCast::class . ':NL',
            'privacy_mode' => 'boolean',
            'display_userlist' => 'boolean',
            'notify_push_admin' => 'boolean',
            'notify_push_news_added' => 'boolean',
            'notify_push_news_edited' => 'boolean',
            'notify_push_activity_added' => 'boolean',
            'notify_push_activity_edited' => 'boolean',
            'notify_push_activity_removed' => 'boolean',
            'notify_push_activity_reminder' => 'boolean',
            'notify_push_subscription_added' => 'boolean',
            'notify_push_subscription_edited' => 'boolean',
            'notify_push_subscription_removed' => 'boolean',
            'notify_mail_admin' => 'boolean',
            'notify_mail_news_added' => 'boolean',
            'notify_mail_news_edited' => 'boolean',
            'notify_mail_activity_added' => 'boolean',
            'notify_mail_activity_edited' => 'boolean',
            'notify_mail_activity_removed' => 'boolean',
            'notify_mail_activity_reminder' => 'boolean',
            'notify_mail_subscription_added' => 'boolean',
            'notify_mail_subscription_edited' => 'boolean',
            'notify_mail_subscription_removed' => 'boolean',
        ];
    }

    // ------------------------------------------------------------------------
    // Custom Eloquent Attributes
    // ------------------------------------------------------------------------

    /**
     * Create Age Attribute
     * @return Attribute
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->date_of_birth)->age,
        );
    }

    /**
     * Full name or Firstname depending on Privacy Mode
     * @return Attribute
     */
    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn() => !$this->privacy_mode || Auth::user() ? $this->first_name . " " . $this->last_name : $this->first_name,
        );
    }

    /**
     * Get the User's main certificate
     * @return Attribute
     */
    protected function certificate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->certificates_regular()->first()->title ?? 'In opleiding'
        );
    }

    /**
     * Get the User's role
     * @return Attribute
     */
    protected function role(): Attribute
    {
        $highestRole = $this->getRoleNames()->first();
        return Attribute::make(
            get: fn() => $highestRole ? RoleEnum::from($highestRole)->getReadableText() : 'Niet geactiveerd'
        );
    }

    /**
     * Get AvatarUrl
     * @return Attribute
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->avatar ? Storage::url($this->avatar) : null,
        );
    }


    // ------------------------------------------------------------------------
    // Query Scopes
    // ------------------------------------------------------------------------

    /**
     * Scope a query to only include active (not soft-deleted and with at least one role) users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('deleted_at')
            ->whereHas('roles');
    }

    /**
     * Scope a query to only include users visible in member listings.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('display_userlist', true);
    }

    /**
     * Scope a query to search users by first or last name.
     *
     * Performs case-insensitive LIKE search on both `first_name`
     * and `last_name` when a non-empty search term is provided.
     *
     * @param Builder $query
     * @param string|null $search The search term to match.
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%");
                $q->orWhere('last_name', 'like', "%$search%");
            });
        }
        return $query;
    }

    /**
     * Scope a query to apply dynamic sorting by a field and direction.
     *
     * If `$field` is provided, orders by that field and direction (default `asc`).
     * Otherwise, defaults to sorting by `last_name`, then `first_name`.
     *
     * @param Builder $query
     * @param string|null $field Column to sort by.
     * @param string|null $direction `asc` or `desc` (default `asc`).
     * @return Builder
     */
    public function scopeSortByField(Builder $query, ?string $field, ?string $direction): Builder
    {
        if ($field) {
            return $query->orderBy($field, $direction ?? 'asc');
        }
        return $query->orderBy('last_name')
            ->orderBy('first_name');
    }

    /**
     * Scope a query to filter by exact column values.
     *
     * Accepts a column name and an array of values. If the value array
     * is non-empty, apply a `WHERE IN` filter to that column. If empty,
     * return the unmodified query.
     *
     * @param Builder $query Eloquent query builder instance.
     * @param string $column The column to filter on (e.g. 'country_id').
     * @param array $filter List of values to include in the filter.
     * @return Builder
     */
    public function scopeFilterByColumn(Builder $query, string $column, array $filter): Builder
    {
        if (!empty($filter)) {
            return $query->whereIn($column, $filter);
        }
        return $query;
    }

    /**
     * Scope a query to filter users by their highest regular certificate.
     *
     * Internally builds a subquery that selects the maximum regular
     * certificate ID per user, then left-joins it to the main `users`
     * table. Supports filtering by certificate IDs, and includes users
     * without any certificate when `0` is included in the filter list.
     *
     * @param Builder $query Eloquent query builder instance.
     * @param int[] $certificates Array of certificate IDs; use `0` to include users without certificates.
     * @return Builder
     */
    public function scopeFilterByCertificates(Builder $query, array $certificates): Builder
    {
        // First create a base query to get the highest certificate per user
        $lastCertificateQuery = DB::table('certificate_user')
            ->join('certificates', 'certificate_user.certificate_id', '=', 'certificates.id')
            ->where('certificates.certificate_type', '=', CertificateTypeEnum::REGULAR)
            ->groupBy('certificate_user.user_id')
            ->select(
                'certificate_user.user_id',
                DB::raw('MAX(certificates.id) as certificate_id')
            );

        // Add the left join to include the highest certificate
        $query->leftJoinSub($lastCertificateQuery, 'last_certificate', function ($join) {
            $join->on('users.id', '=', 'last_certificate.user_id');
        })->select('users.*', 'last_certificate.certificate_id');

        // Apply certificate filtering if provided
        if (!empty($certificates)) {
            // Create a base query
            $query->where(function ($q) use ($certificates) {
                // Filter for specific certificates
                $filteredCertificates = array_diff($certificates, ['0']);
                if (!empty($filteredCertificates)) {
                    $q->whereIn('last_certificate.certificate_id', $filteredCertificates);
                }

                // Include users without certificates if 0 is in the filter
                if (in_array(0, $certificates)) {
                    $q->orWhereNull('last_certificate.certificate_id');
                }
            });
        }

        return $query;

    }

    /**
     * Scope a query to filter by assigned role IDs.
     *
     * Filters users having any of the given role IDs. If `0` is present,
     * includes users without any roles. Combines both conditions using `OR`.
     *
     * @param Builder $query Eloquent query builder instance.
     * @param int[] $roles Array of role IDs; `0` to include users with no roles.
     * @return Builder
     */
    public function scopeFilterByRoles(Builder $query, array $roles): Builder
    {
        if (!empty($roles)) {
            $filteredRoles = array_diff($roles, ['0']);
            if (!empty($filteredRoles)) {
                $query->whereHas('roles', function ($query) use ($filteredRoles) {
                    $query->whereIn('id', $filteredRoles);
                });
            }
            if (in_array(0, $roles)) {
                $query->orWhereDoesntHave('roles');
            }
        }
        return $query;
    }

    // ------------------------------------------------------------------------
    // Remaining methods
    // ------------------------------------------------------------------------

    /**
     * Active instance helper
     * @return bool
     */
    public function isActive(): bool
    {
        return is_null($this->deleted_at)
            && $this->roles()->exists();
    }


    // ------------------------------------------------------------------------
    // Relationships
    // ------------------------------------------------------------------------

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function fcmTokens(): HasMany
    {
        return $this->hasMany(FcmToken::class, 'user_id', 'id');
    }

    public function certificates(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class)
            ->using(CertificateUser::class)
            ->withPivot('id', 'date_of_issue', 'certificate_number', 'federation')
            ->withTimestamps();
    }

    public function certificates_regular(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class)
            ->using(CertificateUser::class)
            ->withPivot('id', 'date_of_issue', 'certificate_number', 'federation')
            ->withTimestamps()
            ->where('certificate_type', CertificateTypeEnum::REGULAR)
            ->orderByDesc('certificate_user.id');
    }

    public function certificates_specialties(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class)
            ->using(CertificateUser::class)
            ->withPivot('id', 'date_of_issue', 'certificate_number', 'federation')
            ->withTimestamps()
            ->where('certificate_type', CertificateTypeEnum::SPECIALTY)
            ->orderByPivot('date_of_issue', 'DESC');
    }

    // ------------------------------------------------------------------------
    // Notification Customization
    // ------------------------------------------------------------------------

    /**
     * Send a custom password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send a custom email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification());
    }

}
