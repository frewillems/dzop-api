<?php

namespace Api\CareTask\Validations;

use Domain\CareTask\CareTaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'string',
            'assigneeId' => 'required|exists:users,id',
            'status' => [
                'required',
                Rule::in(CareTaskStatus::values()),
            ],
        ];
    }
}
