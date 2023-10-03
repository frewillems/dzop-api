<?php

namespace Domain\User;

use Support\Traits\EnumToArray;

enum UserType: string
{
    use EnumToArray;

    case Patient = 'pzon';
    case Caregiver = 'caregiver';
    case CareProvider = 'zorgaanbieder';
}
