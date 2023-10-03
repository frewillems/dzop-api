<?php

namespace Domain\CareTask\Model;

use Domain\User\Model\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Support\Model;

class CareTask extends Model
{
    use HasUuids;

    protected $fillable = ['title', 'description', 'assigneeId', 'status'];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
