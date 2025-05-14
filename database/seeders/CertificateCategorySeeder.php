<?php

namespace Database\Seeders;

use App\Enums\CertificateCategoryStatusEnum;
use App\Models\CertificateCategory;
use Illuminate\Database\Seeder;

class CertificateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CertificateCategory::create([
            'id' => '1',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Duikopleidingen',
            'body' => 'De NOB biedt diverse duikopleidingen aan. Of je nu nog nooit gedoken hebt of je juist als gevorderde duiker wilt specialiseren: het is allemaal mogelijk. Ontdek hieronder welke duikopleiding bij jou past!',
            'created_by' => 1
        ]);
        CertificateCategory::create([
            'id' => '2',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Specialisaties vanaf het 1*-Juniorbrevet',
            'body' => 'Als je je 1*-juniorbrevet hebt, kun je diverse specialisaties volgen, namelijk:',
            'created_by' => 1
        ]);
        CertificateCategory::create([
            'id' => '3',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Specialisaties vanaf 1*-brevet',
            'body' => 'Als je je 1*-brevet hebt kun je diverse specialisaties volgen, namelijk:',
            'created_by' => 1
        ]);
        CertificateCategory::create([
            'id' => '4',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Specialisaties vanaf 2*-brevet',
            'body' => 'Als je je 2*-brevet hebt kun je diverse specialisaties volgen, namelijk:',
            'created_by' => 1
        ]);
        CertificateCategory::create([
            'id' => '5',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Specialisaties vanaf 3*-brevet',
            'body' => 'Als je je 3*-brevet hebt kun je diverse specialisaties volgen, namelijk:',
            'created_by' => 1
        ]);
        CertificateCategory::create([
            'id' => '6',
            'status' => CertificateCategoryStatusEnum::PUBLIC,
            'title' => 'Instructeursopleidingen',
            'body' => 'Lijkt het jou ook zo ontzettend leuk om nieuwe duikers kennis te laten maken met de onderwaterwereld? Word dan duikinstructeur',
            'created_by' => 1
        ]);
    }
}
