<?php

namespace App\Models;

use App\Enums\CertificateCategoryStatusEnum;
use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stevebauman\Purify\Casts\PurifyHtmlOnGet;

class CertificateCategory extends Model
{
    use HasOwnership, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'title',
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
            'status' => CertificateCategoryStatusEnum::class,
            'body' => PurifyHtmlOnGet::class,
        ];
    }

    /**
     * Relationships with other models
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'certificate_category');
    }

}
