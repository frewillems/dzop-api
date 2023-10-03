<?php

namespace Api\CarePlan\Resources;

use Api\User\Resources\UserResource;
use Illuminate\Http\Request;
use Support\Resources\JsonResource;

class CarePlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user' => new UserResource($this->whenLoaded('user')),
            'team' => UserResource::collection($this->whenLoaded('team')),
        ];
    }
}
