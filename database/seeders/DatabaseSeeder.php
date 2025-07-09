<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CertificateCategorySeeder::class,
            CertificateSeeder::class,
            CertificateUserSeeder::class,

        ]);
    }
}
