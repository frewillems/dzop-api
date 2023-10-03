<?php

namespace Domain\CarePlan\Model;

use Domain\CareGoal\Model\CareGoal;
use Domain\User\Model\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Support\Model;

/**
 * @method static create(array $data) CarePlan
 */
class CarePlan extends Model
{
    use HasFactory;
    use HasUuids;
    use LogsActivity;

    protected $fillable = ['status'];
    protected static array $recordEvents = ['retrieved', 'created'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function careGoals(): HasMany
    {
        return $this->hasMany(CareGoal::class);
    }
}
