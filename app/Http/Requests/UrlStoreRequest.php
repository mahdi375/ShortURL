<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => ['required', 'url'],
        ];
    }
}
