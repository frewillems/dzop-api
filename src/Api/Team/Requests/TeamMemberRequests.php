<?php

namespace Api\Team\Requests;

use Domain\User\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamMemberRequests extends FormRequest
{
    public function toArray(): array
    {
        return [
            'userId' => [
                'required',
                Rule::exists('users', 'id')
                    ->whereNot('type', UserType::Patient->value),
            ],
        ];
    }
}
