<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreBorrowingRequest extends FormRequest
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
        // the * means every object inside the array
        return [
            "*.bookId" => ["required","exists:books,id"],
            "*.borrowerId" => ["required","exists:borrowers,id"], 
            "*.borrowDate" => ["required","date",Rule::when($this->filled('returnDate'),"before:return_date")], 
            "*.returnDate" => ["nullable","date","after:borrow_date"],
            "*.status" => ["required", Rule::in(['borrowed', 'returned', 'overdue'])] 
        ];
    }
    protected function prepareForValidation()
    {
        // Accumulator to store the validated data
        $data = [];
        // looping through the requested data after converting them into an array
        // we manually add snake column (we could use collect, map and Str class to convert each keys to snake case)
        // but this implementation handles it smoothly even tho it is not reusable :D
        foreach($this->toArray() as $obj) {
            $obj["book_id"] = $obj["bookId"] ?? null;
            $obj["borrower_id"] = $obj["borrowerId"] ?? null;
            $obj["borrow_date"] = $obj["borrowDate"] ?? null;
            $obj["return_date"] = $obj["returnDate"] ?? null;
            $obj["created_at"] = now();
            $obj["updated_at"] = now();
            $data[] = $obj;
        }
        // finally we merge like we normally do.
        $this->merge($data);
    }

}
