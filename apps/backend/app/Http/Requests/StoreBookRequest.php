<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
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
            "title" => "required|min:3|max:30",
            "author" => "required|min:3|max:255",
            "genre" => ["required", Rule::in(["Horror","Comedy","Drama","Romance","Fantasy"])],
            "publishedYear" => 'required|size:4',
            "isbn" => "required|unique:books|size:13|string",
            "status" => ["required",Rule::in(['available', 'borrowed', 'lost'])]
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            "published_year" => $this->publishedYear, 
        ]);
    }
}
