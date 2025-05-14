<?php

namespace App\Models;

use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificateUser extends Pivot
{
    /**
     * Enable factory for testing/seeding and include common traits.
     *
     */
    use HasOwnership, SoftDeletes;

    public $incrementing = true;
    protected $primaryKey = 'id';
    protected $table = 'certificate_user';
    public $timestamps = true;

    /**
     * Attributes that can be mass assigned.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'certificate_id',
        'date_of_issue',
        'certificate_number',
        'federation',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Attribute casting definitions for dates, enums, booleans, etc.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_of_issue' => 'date',
            'deleted_at' => 'datetime'
        ];
    }

    // ------------------------------------------------------------------------
    // Query Scopes
    // ------------------------------------------------------------------------

    /**
     * Scope a query to only include active (not soft-deleted).
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Scope a query to search certificates by title.
     *
     * Performs case-insensitive LIKE search on `title`
     * when a non-empty search term is provided.
     *
     * @param Builder $query
     * @param string|null $search The search term to match.
     * @return Builder
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->whereHas('certificate', function (Builder $q) use ($search) {
                $q->where('title', 'like', "%$search%");
            });
        }

        return $query;
    }

    /**
     * Scope a query to filter by exact column values.
     *
     * Accepts a column name and an array of values. If the value array
     * is non-empty, apply a `WHERE IN` filter to that column. If empty,
     * return the unmodified query.
     *
     * @param Builder $query Eloquent query builder instance.
     * @param string $column The column to filter on (e.g. 'certificate_type').
     * @param array $filter List of values to include in the filter.
     * @return Builder
     */
    public function scopeFilterByColumn(Builder $query, string $column, array $filter): Builder
    {
        if (empty($filter)) {
            return $query;
        }

        if (in_array($column, ['date_of_issue', 'federation', 'user_id', 'certificate_id'])) {
            return $query->whereIn("{$this->getTable()}.{$column}", $filter);
        }

        return $query->whereHas('certificate', function (Builder $q) use ($column, $filter) {
            $q->whereIn($column, $filter);
        });
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
        return is_null($this->deleted_at);
    }

    // ------------------------------------------------------------------------
    // Relationships
    // ------------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificate(): BelongsTo
    {
        return $this->belongsTo(Certificate::class);
    }


}
