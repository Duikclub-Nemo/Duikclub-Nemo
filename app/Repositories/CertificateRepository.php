<?php

namespace App\Repositories;

use App\Enums\CertificateTypeEnum;
use App\Models\Certificate;

class CertificateRepository
{
    /**
     * GetSelectList
     * Array for form select field
     *
     * @return array
     */
    public static function getSelectList(): array
    {
        $certificates = [[
            'label' => 'Geen brevet / In opleiding',
            'value' => null,
            'selected' => true
        ]];
        foreach (Certificate::all()
                     ->where('certificate_type', '=', CertificateTypeEnum::REGULAR)
                     ->sortBy('id') as $certificate) {
            $certificates[] = array(
                'label' => $certificate->abbreviation,
                'value' => $certificate->id
            );
        }
        return $certificates;
    }

}
