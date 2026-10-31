<?php

namespace App\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'categories' => ['required', 'string', Rule::in(['news', 'training', 'review', 'other'])],
        ];
    }
}
