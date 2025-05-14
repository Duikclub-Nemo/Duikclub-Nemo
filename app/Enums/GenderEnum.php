<?php

namespace App\Enums;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;
    case NON_BINARY = 3;
    case TRANSGENDER = 4;
    case INTERSEX = 5;
    case OTHER = 6;
    case PREFER_NOT_TO_SAY = 7;
    case FISH = 8;

    /**
     * Create a translated and readable value
     * @return string
     */
    public function getReadableText(): string
    {
        return match ($this) {
            self::MALE => 'Man',
            self::FEMALE => 'Vrouw',
            self::NON_BINARY => 'Non-binair',
            self::TRANSGENDER => 'Transgender',
            self::INTERSEX => 'Intersekse',
            self::OTHER => 'Anders',
            self::PREFER_NOT_TO_SAY => 'Zeg ik niet',
            self::FISH => 'Vis',
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
