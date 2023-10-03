<?php

namespace Api\CareGoal\Resources;

use Illuminate\Http\Request;
use Support\Resources\JsonResource;

class CareGoalResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
