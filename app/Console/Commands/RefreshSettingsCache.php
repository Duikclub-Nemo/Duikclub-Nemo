<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class RefreshSettingsCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the settings cache';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Setting::clearAllCache();
        Setting::all()->each(function ($setting) {
            cache()->forever("settings.$setting->key", $setting->value);
        });

        $this->info('Settings cache refreshed!');
    }
}
