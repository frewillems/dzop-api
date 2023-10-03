<?php

namespace Domain\CareTask;

use Support\Traits\EnumToArray;

enum CareTaskStatus: string
{
    use EnumToArray;

    case Todo = 'todo';
    case InProgress = 'in-progress';
    case Done = 'done';
}
