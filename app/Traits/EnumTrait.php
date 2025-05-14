<?php

namespace App\Traits;

trait EnumTrait
{
    /**
     * Converts Enum to a key array.
     * @return array
     */
    public static function keys(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Converts Enum's to value array.
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Converts Enum to a key-value array.
     * @return array
     */
    public static function toArray(): array
    {
        if (empty(self::values())) {
            return self::keys();
        }

        if (empty(self::keys())) {
            return self::values();
        }

        return array_column(self::cases(), 'value', 'name');
    }

}
