<?php

namespace Domain\CareGoal\Model;

use Domain\CarePlan\Model\CarePlan;
use Domain\CareTask\Model\CareTask;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Model;

class CareGoal extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['title', 'description'];

    public function carePlan(): BelongsTo
    {
        return $this->belongsTo(CarePlan::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(CareTask::class);
    }
}
