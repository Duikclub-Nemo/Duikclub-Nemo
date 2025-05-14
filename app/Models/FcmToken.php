<?php

namespace App\Models;

use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FcmToken extends Model
{
    use HasOwnership;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'token',
        'device_info',
    ];

    /**
     * Relationships with other models
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
