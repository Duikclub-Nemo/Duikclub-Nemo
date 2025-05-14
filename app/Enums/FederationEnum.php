<?php

namespace App\Enums;

enum FederationEnum: int
{
    case IADS = 1;
    case IANTD = 2;
    case NOB = 3;
    case PADI = 4;
    case SSI = 5;
    case TDI = 6;
    case VDST = 7;
    case AED =8;

    /**
     * Create a translated and readable value
     * @return string
     */
    public function getReadableText(): string
    {
        return match ($this) {
            self::IADS => 'IADS',
            self::IANTD => 'IANTD',
            self::NOB => 'NOB/CMAS',
            self::PADI => 'PADI',
            self::SSI => 'SSI',
            self::TDI => 'TDI',
            self::VDST => 'VDST',
            self::AED => 'AED',
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
