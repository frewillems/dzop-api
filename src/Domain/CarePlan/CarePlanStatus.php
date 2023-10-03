<?php

namespace Domain\CarePlan;

use Support\Traits\EnumToArray;

enum CarePlanStatus: string
{
    use EnumToArray;

    case Active = 'active';
    case Inactive = 'inactive';
    case Concept = 'concept';
}
