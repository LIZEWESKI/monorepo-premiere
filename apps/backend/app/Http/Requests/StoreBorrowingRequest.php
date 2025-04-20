<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBorrowingRequest extends FormRequest
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
            "bookId" => ["required","exists:books,id"],
            "borrowerId" => ["required","exists:borrowers,id"], 
            "borrowDate" => ["required","date","before:return_date"], 
            "returnDate" => ["nullable","date","after:borrow_date"],
            "status" => ["required", Rule::in(['borrowed', 'returned', 'overdue'])] 
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            "book_id" => $this->bookId,
            "borrower_id" => $this->borrowerId,
            "borrow_date" => $this->borrowDate,
            "return_date" => $this->returnDate,
        ]);
    }

}
