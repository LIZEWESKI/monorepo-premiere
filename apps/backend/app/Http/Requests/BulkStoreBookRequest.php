<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreBookRequest extends FormRequest
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
            "*.title" => "required|min:3|max:30",
            "*.author" => "required|min:3|max:255",
            "*.genre" => ["required", Rule::in(["Horror","Comedy","Drama","Romance","Fantasy"])],
            "*.publishedYear" => 'required|size:4',
            "*.isbn" => "required|unique:books|size:13|string",
            "*.status" => ["required",Rule::in(['available', 'borrowed', 'lost'])]
        ];
    }
    protected function prepareForValidation()
    {
        $data = [];
        foreach($this->toArray() as $obj) {
            // reassigned publishedYear to snake case and return null if publishedYear isn't defined;
            $obj['published_year'] = $obj['publishedYear'] ?? null;
            $obj['created_at'] = now();
            $obj['updated_at'] = now();
            $data[] = $obj;
        }
        $this->merge($data);
    }
}
