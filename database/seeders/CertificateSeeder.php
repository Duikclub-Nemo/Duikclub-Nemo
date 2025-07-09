<?php

namespace Database\Seeders;

use App\Enums\CertificateStatusEnum;
use App\Enums\CertificateTypeEnum;
use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::create([
            'id' => 1,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Jeugdopleiding (vanaf 8 jaar)',
            'alt_title' => null,
            'min_age' => 8,
            'abbreviation' => 'Jeugdopleiding',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 10,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => '1*-Junior duikopleiding (vanaf 12 jaar)',
            'alt_title' => null,
            'min_age' => 12,
            'abbreviation' => '1* Junior',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 20,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => true,
            'title' => '1*-duikopleiding',
            'alt_title' => 'Open Water Diver',
            'min_age' => 14,
            'abbreviation' => '1* duiker',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 21,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => true,
            'title' => '2*-duikopleiding',
            'alt_title' => 'Advanced Open Water Diver',
            'min_age' => 15,
            'abbreviation' => '2* duiker',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 22,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => true,
            'title' => '3*-duikopleiding',
            'alt_title' => 'Divemaster',
            'min_age' => 18,
            'abbreviation' => '3* duiker',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 23,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => true,
            'title' => '4*-duikopleiding',
            'alt_title' => 'Master Scuba Diver',
            'min_age' => 18,
            'abbreviation' => '4* duiker',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 24,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 1,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Duikbegeleider',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Duikbegeleider',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 30,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => '1* Instructeur',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => '1* Instructeur',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 31,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => '2* Instructeur',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => '2* Instructeur',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 32,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Praktijkbegeleider',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Praktijkbegeleider',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 33,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Leercoach',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Leercoach',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 34,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'PvB Beoordelaar',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'PvB Beoordelaar',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 35,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Instructeur Trainer',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Instructeur Trainer',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 36,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 6,
            'certificate_type' => CertificateTypeEnum::REGULAR,
            'teachable' => false,
            'title' => 'Docent',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Docent',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 40,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 2,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Onderwaterfotografie basis',
            'alt_title' => null,
            'min_age' => 12,
            'abbreviation' => 'Onderwaterfotografie basis',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 41,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 2,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Onderwaterbiologie',
            'alt_title' => null,
            'min_age' => 12,
            'abbreviation' => 'Onderwaterbiologie',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 42,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 2,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Onderwateroriëntatie',
            'alt_title' => null,
            'min_age' => 12,
            'abbreviation' => 'Onderwateroriëntatie',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 50,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 3,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Droogpakduiken',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Droogpakduiken',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 51,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 3,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Nitrox basis',
            'alt_title' => null,
            'min_age' => 14,
            'abbreviation' => 'Nitrox basis',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 52,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 3,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Introductie onderwaterarcheologie',
            'alt_title' => null,
            'min_age' => 14,
            'abbreviation' => 'Onderwaterarcheologie',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 53,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 3,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Reanimatie',
            'alt_title' => null,
            'min_age' => 14,
            'abbreviation' => 'Reanimatie',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 60,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Onderwaterfotografie gevorderd',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Onderwaterfotografie gevorderd',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 61,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'IJsduiken',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'IJsduiken',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 62,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Wrakduiken',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Wrakduiken',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 63,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Onderwaterbiologie wereldwijd',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Onderwaterbiologie wereldwijd',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 64,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Volgelaatsmasker',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Volgelaatsmasker',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 65,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Zoeken & Bergen',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Zoeken & Bergen',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 66,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 4,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Driftduiken',
            'alt_title' => null,
            'min_age' => 15,
            'abbreviation' => 'Driftduiken',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 70,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 5,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Decompressieduiken',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Decompressieduiken',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 71,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 5,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Nitrox gevorderd',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Nitrox gevorderd',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
        Certificate::create([
            'id' => 72,
            'status' => CertificateStatusEnum::PUBLIC,
            'certificate_category' => 5,
            'certificate_type' => CertificateTypeEnum::SPECIALTY,
            'teachable' => false,
            'title' => 'Grotduiktechnieken open water',
            'alt_title' => null,
            'min_age' => 18,
            'abbreviation' => 'Grotduiktechnieken open water',
            'requirements' => null,
            'body' => null,
            'created_by' => 1
        ]);
    }
}
