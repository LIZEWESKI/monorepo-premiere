<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
        $method = $this->method();
        if($method === "PUT") {
            return [
                "title" => "required|min:3|max:30",
                "author" => "required|min:3|max:255",
                "genre" => ["required", Rule::in(["Horror","Comedy","Drama","Romance","Fantasy"])],
                "publishedYear" => 'required|size:4',
                "isbn" => ["required","size:13","string",Rule::unique('books', 'isbn')->ignore($this->book)],
                "status" => ["required",Rule::in(['available', 'borrowed', 'lost'])]
            ];
        }else{ 
            return [
                "title" => "sometimes|required|min:3|max:30",
                "author" => "sometimes|required|min:3|max:255",
                "genre" => ["sometimes","required", Rule::in(["Horror","Comedy","Drama","Romance","Fantasy"])],
                "publishedYear" => 'sometimes|required|size:4',
                "isbn" => ["sometimes","required","size:13","string",Rule::unique('books', 'isbn')->ignore($this->book)],
                "status" => ["sometimes","required",Rule::in(['available', 'borrowed', 'lost'])]
            ];
        }
    }
    protected function prepareForValidation()
    {
        if($this->publishedYEar) {
            $this->merge([
                "published_year" => $this->publishedYear, 
            ]);
        }
    }
}
