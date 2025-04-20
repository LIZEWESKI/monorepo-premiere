<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBorrowingRequest extends FormRequest
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
                "bookId" => ["required","exists:books,id"],
                "borrowerId" => ["required","exists:borrowers,id"], 
                "borrowDate" => ["required","date",Rule::when($this->filled('returnDate'), ['before:returnDate'])], 
                "returnDate" => ["nullable","date","after:borrow_date"],
                "status" => ["required", Rule::in(['borrowed', 'returned', 'overdue'])] 
            ];
        } else {
            return [
                "bookId" => ["sometimes","required","exists:books,id"],
                "borrowerId" => ["sometimes","required","exists:borrowers,id"], 
                "borrowDate" => ["sometimes","required","date",Rule::when($this->filled('returnDate'), ['before:returnDate'])], 
                "returnDate" => ["sometimes","date","after:borrow_date","nullable"],
                "status" => ["sometimes","required", Rule::in(['borrowed', 'returned', 'overdue'])] 
            ];
        }
    }
    protected function prepareForValidation()
    {
        // Instead of converting the keys manually to snake case
        // we first define the keys inside an array
        $fields = [
            'bookId',
            'borrowerId',
            'borrowDate',
            'returnDate',
        ];
    
        // we only retrieve the request data that exist in the $fields array
        $data = collect($this->only($fields))
            ->filter() // it removes null/empty values (works for PATCH)
            ->mapWithKeys(function ($value, $key) {
                return [Str::snake($key) => $value]; // we convert the keys to snake case using Str
            });
        // we finally merge the data we care about and send it to get validated :)
        $this->merge($data->all());
    }
}
