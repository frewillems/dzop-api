<?php

namespace Domain\CareGoal;

use Domain\CareGoal\Model\CareGoal;
use Domain\Notification\Model\Notification;

class CareGoalObserver
{
    public function created(CareGoal $goal): void
    {
        $goal->carePlan()->user()->notifications()->create([
            'message' => 'Testje!',
            'causer_id' => auth()->user()->id,
        ]);
    }
}
