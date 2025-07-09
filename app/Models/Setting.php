<?php

namespace App\Models;

use App\Enums\SettingTypeEnum;
use App\Traits\HasOwnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasOwnership, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string|class-string>
     */
    protected $casts = [
        'type' => SettingTypeEnum::class,
    ];

    /**
     * Get a setting value by key, with caching.
     */
    public static function get(string $key, $default = null): mixed
    {
        return Cache::rememberForever("settings.$key", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value and update cache.
     */
    public static function set(string $key, $value): Setting
    {
        $setting = static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forever("settings.$key", $value);
        return $setting;
    }

    /**
     * Clear a specific setting from the cache.
     */
    public static function clearCache(string $key): void
    {
        Cache::forget("settings.$key");
    }

    /**
     * Clear all settings from the cache.
     */
    public static function clearAllCache(): void
    {
        Cache::forget('settings');
        static::all()->each(function ($setting) {
            Cache::forget("settings.$setting->key");
        });
    }

}
