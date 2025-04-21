<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowerRequest extends FormRequest
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
            "name" => ["required","max:250", "min:4"],
            "email" => ["required","email", "unique:borrowers,email"],
            "member_since" => ["required","date"],
            "active" => ["required","boolean"],
        ];
    }
    protected function prepareForValidation()
    {
        // These lines of code are just for showing off :D
        // $fields = ["memberSince"];
        // $data = collect($this->only($fields))
        //         ->filter()
        //         ->mapWithKeys(function($value, $key) {
        //             return [Str::snake($key) => $value];
        //         });
        // $this->merge($data->all());

        // The easiest and simplest way since we only have one column to merge :
        if($this->memberSince) $this->merge(["member_since" => $this->memberSince]);
    }
}
