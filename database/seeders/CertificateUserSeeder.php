<?php

namespace Database\Seeders;

use App\Enums\CertificateTypeEnum;
use App\Enums\FederationEnum;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CertificateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Retrieve all users and certificates
        $users = User::whereNot('id', '=', 1)->get();
        // Percentage of users who receive a certificate (e.g., 50%)
        $percentage = 80;

        foreach ($users as $user) {
            // Randomize whether this user gets certificates
            if (rand(1, 100) <= $percentage) {
                // Randomly select 3 certificates per user
                $regular = Certificate::where('certificate_type', '=', CertificateTypeEnum::REGULAR)->get()->random(3)->pluck('id')->toArray();
                $specialties = Certificate::where('certificate_type', '=', CertificateTypeEnum::SPECIALTY)->get()->random(5)->pluck('id')->toArray();

                // Create an array with certificates and additional pivot data
                $pivotRegular = [];
                foreach ($regular as $certificate) {
                    $pivotRegular[$certificate] = [
                        'date_of_issue' => Carbon::now()->subDays(rand(1, 365)), // Random date in the past year
                        'federation' => fake()->randomElement(FederationEnum::class),
                        'created_by' => $user->id,
                        'created_at' => Now(),
                    ];
                }
                $pivotSpecialties = [];
                foreach ($specialties as $certificate) {
                    $pivotSpecialties[$certificate] = [
                        'date_of_issue' => Carbon::now()->subDays(rand(1, 365)), // Random date in the past year
                        'federation' => fake()->randomElement(FederationEnum::class),
                        'created_by' => $user->id,
                        'created_at' => Now(),
                    ];
                }

                // Link certificates with additional data without duplicates
                $user->certificates_regular()->syncWithoutDetaching($pivotRegular);
                $user->certificates_specialties()->syncWithoutDetaching($pivotSpecialties);
            }
        }

    }
}
