<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CertificateTypeEnum: int
{
    use EnumTrait;

    case REGULAR = 1;
    case SPECIALTY = 2;

    /**
     * Create a translated and readable value
     * @return string
     */
    public function getReadableText(): string
    {
        return match ($this) {
            self::REGULAR => 'Duikbrevet',
            self::SPECIALTY => 'Specialty',
        };
    }

    /**
     * Create SelectList with readable text
     * @return array
     */
    public static function getSelectList(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[] = array(
                'label' => $case->getReadableText(),
                'value' => $case->value
            );
        }
        return $cases;
    }

}


