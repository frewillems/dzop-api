<?php

namespace Support;

use Spatie\Activitylog\LogOptions;
use Support\Traits\CamelCasing;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use CamelCasing;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
