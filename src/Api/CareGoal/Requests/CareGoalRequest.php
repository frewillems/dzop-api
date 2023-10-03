<?php

namespace Api\CareGoal\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareGoalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'string',
        ];
    }
}
