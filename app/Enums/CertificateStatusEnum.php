<?php

namespace App\Enums;

enum CertificateStatusEnum: int
{
    case HIDDEN = 0;
    case PRIVATE = 1;
    case PUBLIC = 2;
}
