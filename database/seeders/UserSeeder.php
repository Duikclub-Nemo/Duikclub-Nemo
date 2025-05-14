<?php

namespace Database\Seeders;

use App\Enums\FederationEnum;
use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         * Create Admin
         */
        User::factory()->create([
            'email' => 'admin@dcnemo.nl',
            'first_name' => 'Admin',
            'deleted_at' => null,
        ])->assignRole(RoleEnum::ADMIN);

        /**
         * Create Instructor
         */
        User::factory()->create([
            'email' => 'instructeur@dcnemo.nl',
            'first_name' => 'Instructeur',
            'deleted_at' => null,
        ])->assignRole(RoleEnum::INSTRUCTOR);

        /**
         * Create User
         */
        User::factory()->create([
            'email' => 'lid@dcnemo.nl',
            'first_name' => 'Lid',
            'deleted_at' => null,
        ])->assignRole(RoleEnum::USER);

        /**
         * Create Users
         */
        User::factory(30)
            ->withRole(RoleEnum::USER)
            ->create();

        // Clear avatars
        $avatarPath = public_path('images/avatars');
        if (File::exists($avatarPath)) {
            File::cleanDirectory($avatarPath);
        }

    }
}
