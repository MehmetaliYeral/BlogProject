<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             
            "title"=> ["required", "max:255"],
            "slug"=> [ "max:255" ],
            "description"=> ["max:255"],
            "seo_keywords" => ["max:255"],
            "seo_description" => ["max:255"],
            "body" => ["required"]
        ];
    }
}
