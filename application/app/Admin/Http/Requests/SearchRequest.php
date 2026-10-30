<?php

namespace App\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => ['required', 'string'],
        ];
    }
}
