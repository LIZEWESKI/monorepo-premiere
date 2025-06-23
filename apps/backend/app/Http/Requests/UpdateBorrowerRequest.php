<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBorrowerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan("update");
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
                "name" => ["required","max:250", "min:4"],
                "email" => ["required","email", Rule::unique("borrowers","email")->ignore($this->borrower)],
                "member_since" => ["required","date"],
                "active" => ["required","boolean"],
            ];
        } else {
            return [
                "name" => ["sometimes","required","max:250", "min:4"],
                "email" => ["sometimes","required","email", Rule::unique("borrowers","email")->ignore($this->borrower)],
                "member_since" => ["sometimes","required","date"],
                "active" => ["sometimes","required","boolean"],
            ];
        }
    }
    protected function prepareForValidation()
    {
        // now this code sorta pays off since we need to work with patch request!
        $fields = ["memberSince"];
        $data = collect($this->only($fields))
                ->filter()
                ->mapWithKeys(function($value, $key) {
                    return [Str::snake($key) => $value];
                });
        $this->merge($data->all());

    }
}
