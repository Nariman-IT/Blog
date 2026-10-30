<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'max:20', Rule::in(['active', 'banned',])],
        ];
    }
}
