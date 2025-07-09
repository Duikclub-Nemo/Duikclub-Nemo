<?php

namespace App\Models;

use App\Enums\CertificateStatusEnum;
use App\Enums\CertificateTypeEnum;
use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class Certificate extends Model
{
    use HasOwnership, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'certificate_category',
        'certificate_type',
        'teachable',
        'title',
        'alt_title',
        'min_age',
        'abbreviation',
        'requirements',
        'body',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => CertificateStatusEnum::class,
            'certificate_type' => CertificateTypeEnum::class,
            'requirements' => PurifyHtmlOnGet::class,
            'body' => PurifyHtmlOnGet::class,
        ];
    }

    /**
     * Relationships with other models
     */
    public function certificateCategory(): HasOne
    {
        return $this->hasOne(CertificateCategory::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('id', 'date_of_issue', 'certificate_number', 'federation');
    }

}
