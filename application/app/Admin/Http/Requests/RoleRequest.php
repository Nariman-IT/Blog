<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => ['required', 'string', 'max:20', Rule::in(['user', 'author',])],
        ];
    }
}
