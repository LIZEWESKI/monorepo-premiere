<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "bookId" => $this->book_id,
            "borrowerId" => $this->borrower_id,
            "borrowDate" => $this->borrow_date,
            "returnDate" => $this->return_date,
            "status" => $this->status,
        ];
    }
}
