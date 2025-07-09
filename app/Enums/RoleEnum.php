<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum RoleEnum: string
{
    use EnumTrait;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case INSTRUCTOR = 'instructor';
    case USER = 'user';

    /**
     * Create a translated and readable value
     * @return string
     */
    public function getReadableText(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Beheerder',
            self::ADMIN => 'Bestuurder',
            self::INSTRUCTOR => 'Instructeur',
            self::USER => 'Lid',
        };
    }

}
