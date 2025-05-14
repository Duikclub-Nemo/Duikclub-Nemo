<?php

namespace App\Enums;

enum SettingTypeEnum: int
{
    case STRING = 1;
    case INT = 2;
    case BOOLEAN = 3;
    case DATE = 4;
    case DATETIME = 5;
    case TEXT = 6;
}
