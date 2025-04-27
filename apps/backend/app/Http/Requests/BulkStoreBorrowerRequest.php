<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreBorrowerRequest extends FormRequest
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
            "*.name" => ["required","max:250", "min:4"],
            "*.email" => ["required","email", "unique:borrowers,email"],
            "*.memberSince" => ["required","date"],
            "*.active" => ["required","boolean"],
        ];
    }
    protected function prepareForValidation()
    {
        $data = [];
        foreach($this->toArray() as $obj) {
            $obj["member_since"] = $obj["memberSince"] ?? null;
            $obj["created_at"] = now();
            $obj["updated_at"] = now();
            $data[] = $obj;
        };
        $this->merge($data);
    }
}
