<?php

namespace Database\Seeders;

use App\Enums\SettingTypeEnum;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::clearAllCache();

        Setting::insert([
            [
                'key' => 'app_title',
                'value' => 'Duikclub Nemo',
                'type' => SettingTypeEnum::STRING,
                'created_by' => 1

            ],
            [
                'key' => 'app_subtitle',
                'value' => 'Waag ook eens een sprong in het diepe...',
                'type' => SettingTypeEnum::STRING,
                'created_by' => 1
            ],
            [
                'key' => 'canRegister',
                'value' => '1',
                'type' => SettingTypeEnum::BOOLEAN,
                'created_by' => 1
            ],
            [
                'key' => 'canLogin',
                'value' => '1',
                'type' => SettingTypeEnum::BOOLEAN,
                'created_by' => 1
            ],
            [
                'key' => 'canResetPassword',
                'value' => '1',
                'type' => SettingTypeEnum::BOOLEAN,
                'created_by' => 1
            ],
            [
                'key' => 'terms_date',
                'value' => '2024-01-01',
                'type' => SettingTypeEnum::DATE,
                'created_by' => 1
            ],
            [
                'key' => 'terms',
                'value' => 'terms',
                'type' => SettingTypeEnum::TEXT,
                'created_by' => 1
            ]
        ]);

    }
}
