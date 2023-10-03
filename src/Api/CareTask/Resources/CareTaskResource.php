<?php

namespace Api\CareTask\Resources;

use Api\User\Resources\UserResource;
use Illuminate\Http\Request;
use Support\Resources\JsonResource;

class CareTaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'assignee' => new UserResource($this->whenLoaded('assignee')),
            'status' => $this->status,
        ];
    }
}
