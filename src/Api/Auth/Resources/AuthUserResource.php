<?php

namespace Api\Auth\Resources;

use Api\CarePlan\Resources\CarePlanResource;
use Illuminate\Http\Request;
use Support\Resources\JsonResource;

class AuthUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'type' => $this->type,
            'carePlan' => new CarePlanResource($this->whenLoaded('carePlan')),
        ];
    }
}
